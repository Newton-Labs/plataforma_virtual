<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use AppBundle\Entity\Curso;
use UserBundle\Entity\Usuario;
use  Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AsignacionController extends Controller
{
    /**
     * Don't forget to add this route annotation!
     *
     * @Route("/listarCursos/", name="asignacion")
     * 
     */
    public function listarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $cursos = $em->getRepository('AppBundle:Curso')->findAll();

		return $this->render('AppBundle:Asignacion:listar.html.twig', array('cursos' => $cursos));
    }

    /**
     * Don't forget to add this route annotation!
     *
     * @Route("/listarCursos/agregar/{usuario_id}/{curso_id}/", name="add_asignacion")
     * @ParamConverter("usuario", class="UserBundle:Usuario", options={"id"="usuario_id"})
     * @ParamConverter("curso", class="AppBundle:Curso", options={"id"="curso_id"})
     */
    public function agregarCursoAction(Request $request, Curso $curso, Usuario $usuario) {
    	$em = $this->getDoctrine()->getManager();
    	$cursos = $em->getRepository('AppBundle:Curso')->findAll();
    	$usuario->addCurso($curso);
            $em->persist($usuario);
            $em->flush();

		return $this->render('AppBundle:Asignacion:listar.html.twig', array('cursos' => $cursos,
			'usuario' => $usuario ));
    }
}
<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use AppBundle\Entity\Curso;
use UserBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;

class AsignacionController extends Controller
{
    /**
     * Don't forget to add this route annotation!
     *
     * @Route("{usuario_id}/asignar/cursos", name="asignacion")
     * @ParamConverter("usuario", class="UserBundle:Usuario", options={"id"="usuario_id"})
     * 
     */
    public function listarAction(Request $request, Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();
        $cursos = $em->getRepository('AppBundle:Curso')->findAll();

        $cursosAsignados = $usuario->getCursos();

        $returnData = [];

        foreach($cursos as $curso){       
            if (!$cursosAsignados->contains($curso)) {
                $returnData[] = $curso;
            }
        } 
        
		return $this->render('AppBundle:Asignacion:asignar.html.twig', array('cursos' => $returnData));
    }

    /**
     * Método para asingar un curso a un usuario
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
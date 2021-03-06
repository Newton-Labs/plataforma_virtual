<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//sirve para extender de friendofsymfony
use FOS\UserBundle\Model\User as BaseUser;

//sirve para validar los campos del formulario

/**
 * @ORM\Table(name="Usuarios")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nombreCompleto", type="string", length=50)
     */
    private $nombreCompleto;
    /**
     * @ORM\ManyToMany(targetEntity="CursoBundle\Entity\Curso", inversedBy="usuarios")
     * @ORM\JoinTable(name="cursos_usuario")
     **/
    private $cursos;

    /**
     * @ORM\OneToMany(targetEntity="TutoriaBundle\Entity\Tutoria", mappedBy="usuario")
     **/
    private $tutorias;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();// construye los metodos y atributos de Base
        $this->cursos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tutorias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set nombreCompleto.
     *
     * @param string $nombreCompleto
     *
     * @return Usuario
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }
    /**
     * Get nombreCompleto.
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Add cursos.
     *
     * @param \CursoBundle\Entity\Curso $cursos
     *
     * @return Usuario
     */
    public function addCurso(\CursoBundle\Entity\Curso $cursos)
    {
        $this->cursos[] = $cursos;

        return $this;
    }
    /**
     * Remove cursos.
     *
     * @param \CursoBundle\Entity\Curso $cursos
     */
    public function removeCurso(\CursoBundle\Entity\Curso $cursos)
    {
        $this->cursos->removeElement($cursos);
    }
    /**
     * Get cursos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }
    /**
     * Get expiresAt.
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials_expire_at.
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }
    public function __toString()
    {
        return $this->nombreCompleto;
    }

    /**
     * Add tutorias.
     *
     * @param \TutoriaBundle\Entity\Tutoria $tutorias
     *
     * @return Usuario
     */
    public function addTutoria(\TutoriaBundle\Entity\Tutoria $tutorias)
    {
        $this->tutorias[] = $tutorias;
        $tutorias->setUsuario($this);

        return $this;
    }
    /**
     * Remove tutorias.
     *
     * @param \TutoriaBundle\Entity\Tutoria $tutorias
     */
    public function removeTutoria(\TutoriaBundle\Entity\Tutoria $tutorias)
    {
        $this->tutorias->removeElement($tutorias);
    }
    /**
     * Get tutorias.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTutorias()
    {
        return $this->tutorias;
    }

    public function hasRole($role)
    {
        if (in_array($role, $this->getRoles())) {
            return true;
        }

        return false;
    }
}

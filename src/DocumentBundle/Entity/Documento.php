<?php

namespace DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="Documentos")
 */
class Documento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * [$tipoDocumento boolean para saber si es parcial o hoja de trabajo]
     * @var boolean
     * true = parcial
     * false = hoja de trabajo
     * @ORM\Column(name="tipoDocumento",type="boolean")
     */
    private $tipoDocumento;

    /**
     * [$numeroDocumento numero de documento de acuerdo al programa]
     * @var integer
     * @ORM\Column(name="numeroDocumento",type="integer")
     */
    private $numeroDocumento;

    /**
     * [$curso relacion one to many a curso]
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="CursoBundle\Entity\Curso",inversedBy="documentos")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="document", fileNameProperty="documentName")
     * 
     * @Assert\File(
     * maxSize="16M",
     * mimeTypes = {"application/pdf", "application/x-pdf","application/msword",
     *    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"},
     * mimeTypesMessage = "Por favor solo subir archivos PDF o Word ",
     * )
     * 
     * @var File
     */
    private $documentFile;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     *
     * @var string
     */
    private $documentName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setDocumentFile(File $file = null)
    {
        $this->documentFile = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getDocumentFile()
    {
        return $this->documentFile;
    }

    /**
     * @param string $imageName
     */
    public function setDocumentName($docName)
    {
        $this->documentName = $docName;
    }

    /**
     * @return string
     */
    public function getDocumentName()
    {
        return $this->documentName;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set tipoDocumento
     *
     * @param boolean $tipoDocumento
     * @return Documento
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return boolean 
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set numeroDocumento
     *
     * @param integer $numeroDocumento
     * @return Documento
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return integer 
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set curso
     *
     * @param \CursoBundle\Entity\Curso $curso
     * @return Documento
     */
    public function setCurso(\CursoBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \CursoBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }
}

<?php

namespace Fundeuis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioCurso
 *
 * @ORM\Table(name="usuario_curso", indexes={@ORM\Index(name="UsuarioCurso_Curso_idx", columns={"curso"}), @ORM\Index(name="UsuarioCurso_Usuario_idx", columns={"usuario"})})
 * @ORM\Entity
 */
class UsuarioCurso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuarioCurso", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuariocurso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '0';

    /**
     * @var \Curso
     *
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="curso", referencedColumnName="idCurso")
     * })
     */
    private $curso;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="idUsuario")
     * })
     */
    private $usuario;



    /**
     * Get idusuariocurso
     *
     * @return integer 
     */
    public function getIdusuariocurso()
    {
        return $this->idusuariocurso;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return UsuarioCurso
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set curso
     *
     * @param \Fundeuis\FrontalBundle\Entity\Curso $curso
     * @return UsuarioCurso
     */
    public function setCurso(\Fundeuis\FrontalBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \Fundeuis\FrontalBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set usuario
     *
     * @param \Fundeuis\FrontalBundle\Entity\Usuario $usuario
     * @return UsuarioCurso
     */
    public function setUsuario(\Fundeuis\FrontalBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Fundeuis\FrontalBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

<?php

namespace Fundeuis\InscripcionpreicfesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="curso", indexes={@ORM\Index(name="Curso_NombreCurso_idx", columns={"nombreCurso"})})
 * @ORM\Entity
 */
class Curso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCurso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcurso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="datetime", nullable=false)
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="datetime", nullable=false)
     */
    private $fechafin;

    /**
     * @var string
     *
     * @ORM\Column(name="duracion", type="string", length=3, nullable=false)
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicio", type="time", nullable=false)
     */
    private $horainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaFin", type="time", nullable=false)
     */
    private $horafin;

    /**
     * @var string
     *
     * @ORM\Column(name="intensidadHoraria", type="string", length=2, nullable=false)
     */
    private $intensidadhoraria;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \Nombrecurso
     *
     * @ORM\ManyToOne(targetEntity="Nombrecurso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nombreCurso", referencedColumnName="idNombreCurso")
     * })
     */
    private $nombrecurso;



    /**
     * Get idcurso
     *
     * @return integer 
     */
    public function getIdcurso()
    {
        return $this->idcurso;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     * @return Curso
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime 
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin
     *
     * @param \DateTime $fechafin
     * @return Curso
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return \DateTime 
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     * @return Curso
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set horainicio
     *
     * @param \DateTime $horainicio
     * @return Curso
     */
    public function setHorainicio($horainicio)
    {
        $this->horainicio = $horainicio;

        return $this;
    }

    /**
     * Get horainicio
     *
     * @return \DateTime 
     */
    public function getHorainicio()
    {
        return $this->horainicio;
    }

    /**
     * Set horafin
     *
     * @param \DateTime $horafin
     * @return Curso
     */
    public function setHorafin($horafin)
    {
        $this->horafin = $horafin;

        return $this;
    }

    /**
     * Get horafin
     *
     * @return \DateTime 
     */
    public function getHorafin()
    {
        return $this->horafin;
    }

    /**
     * Set intensidadhoraria
     *
     * @param string $intensidadhoraria
     * @return Curso
     */
    public function setIntensidadhoraria($intensidadhoraria)
    {
        $this->intensidadhoraria = $intensidadhoraria;

        return $this;
    }

    /**
     * Get intensidadhoraria
     *
     * @return string 
     */
    public function getIntensidadhoraria()
    {
        return $this->intensidadhoraria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Curso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set nombrecurso
     *
     * @param \Fundeuis\InscripcionpreicfesBundle\Entity\Nombrecurso $nombrecurso
     * @return Curso
     */
    public function setNombrecurso(\Fundeuis\InscripcionpreicfesBundle\Entity\Nombrecurso $nombrecurso = null)
    {
        $this->nombrecurso = $nombrecurso;

        return $this;
    }

    /**
     * Get nombrecurso
     *
     * @return \Fundeuis\InscripcionpreicfesBundle\Entity\Nombrecurso 
     */
    public function getNombrecurso()
    {
        return $this->nombrecurso;
    }
}

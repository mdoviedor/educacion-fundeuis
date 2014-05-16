<?php

namespace Fundeuis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colegio
 *
 * @ORM\Table(name="colegio", indexes={@ORM\Index(name="Colegio_Ciudad_idx", columns={"ciudad"})})
 * @ORM\Entity
 */
class Colegio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idColegio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcolegio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=false)
     */
    private $nombre;

    /**
     * @var \Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad", referencedColumnName="idCiudad")
     * })
     */
    private $ciudad;



    /**
     * Get idcolegio
     *
     * @return integer 
     */
    public function getIdcolegio()
    {
        return $this->idcolegio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Colegio
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set ciudad
     *
     * @param \Fundeuis\FrontalBundle\Entity\Ciudad $ciudad
     * @return Colegio
     */
    public function setCiudad(\Fundeuis\FrontalBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Fundeuis\FrontalBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }
}

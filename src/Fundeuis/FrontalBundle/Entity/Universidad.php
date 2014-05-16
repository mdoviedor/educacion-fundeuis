<?php

namespace Fundeuis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Universidad
 *
 * @ORM\Table(name="universidad", indexes={@ORM\Index(name="Universidad_Ciudad_idx", columns={"ciudad"})})
 * @ORM\Entity
 */
class Universidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUniversidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduniversidad;

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
     * Get iduniversidad
     *
     * @return integer 
     */
    public function getIduniversidad()
    {
        return $this->iduniversidad;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Universidad
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
     * @return Universidad
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

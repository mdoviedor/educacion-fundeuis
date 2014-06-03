<?php

namespace Fundeuis\InscripcionpreicfesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conocimientocursos
 *
 * @ORM\Table(name="conocimientocursos")
 * @ORM\Entity
 */
class Conocimientocursos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idConocimientoCursos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconocimientocursos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;



    /**
     * Get idconocimientocursos
     *
     * @return integer 
     */
    public function getIdconocimientocursos()
    {
        return $this->idconocimientocursos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Conocimientocursos
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
}

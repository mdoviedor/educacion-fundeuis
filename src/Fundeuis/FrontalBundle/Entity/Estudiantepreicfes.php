<?php

namespace Fundeuis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudiantepreicfes
 *
 * @ORM\Table(name="estudiantepreicfes", uniqueConstraints={@ORM\UniqueConstraint(name="Usuario_UNIQUE", columns={"usuario"})}, indexes={@ORM\Index(name="EstudiantePreIcfes_ConocimientoCursos_idx", columns={"conocimientoCursos"}), @ORM\Index(name="EstudiantePreIcfes_Colegio_idx", columns={"colegio"}), @ORM\Index(name="EstudiantePreIcfes_Universidad_idx", columns={"universidad"})})
 * @ORM\Entity
 */
class Estudiantepreicfes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEstudiantePreIcfes", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestudiantepreicfes;

    /**
     * @var string
     *
     * @ORM\Column(name="nombresAcudiente", type="string", length=80, nullable=false)
     */
    private $nombresacudiente;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidosAcudiente", type="string", length=80, nullable=false)
     */
    private $apellidosacudiente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijoAcudiente", type="string", length=15, nullable=true)
     */
    private $telefonofijoacudiente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoCelularAcudiente", type="string", length=15, nullable=true)
     */
    private $telefonocelularacudiente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreArchivo", type="string", length=100, nullable=true)
     */
    private $nombrearchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="rutaArchivo", type="string", length=100, nullable=true)
     */
    private $rutaarchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=100, nullable=true)
     */
    private $foto;

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
     * @var \Conocimientocursos
     *
     * @ORM\ManyToOne(targetEntity="Conocimientocursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="conocimientoCursos", referencedColumnName="idConocimientoCursos")
     * })
     */
    private $conocimientocursos;

    /**
     * @var \Colegio
     *
     * @ORM\ManyToOne(targetEntity="Colegio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colegio", referencedColumnName="idColegio")
     * })
     */
    private $colegio;

    /**
     * @var \Universidad
     *
     * @ORM\ManyToOne(targetEntity="Universidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="universidad", referencedColumnName="idUniversidad")
     * })
     */
    private $universidad;



    /**
     * Get idestudiantepreicfes
     *
     * @return integer 
     */
    public function getIdestudiantepreicfes()
    {
        return $this->idestudiantepreicfes;
    }

    /**
     * Set nombresacudiente
     *
     * @param string $nombresacudiente
     * @return Estudiantepreicfes
     */
    public function setNombresacudiente($nombresacudiente)
    {
        $this->nombresacudiente = $nombresacudiente;

        return $this;
    }

    /**
     * Get nombresacudiente
     *
     * @return string 
     */
    public function getNombresacudiente()
    {
        return $this->nombresacudiente;
    }

    /**
     * Set apellidosacudiente
     *
     * @param string $apellidosacudiente
     * @return Estudiantepreicfes
     */
    public function setApellidosacudiente($apellidosacudiente)
    {
        $this->apellidosacudiente = $apellidosacudiente;

        return $this;
    }

    /**
     * Get apellidosacudiente
     *
     * @return string 
     */
    public function getApellidosacudiente()
    {
        return $this->apellidosacudiente;
    }

    /**
     * Set telefonofijoacudiente
     *
     * @param string $telefonofijoacudiente
     * @return Estudiantepreicfes
     */
    public function setTelefonofijoacudiente($telefonofijoacudiente)
    {
        $this->telefonofijoacudiente = $telefonofijoacudiente;

        return $this;
    }

    /**
     * Get telefonofijoacudiente
     *
     * @return string 
     */
    public function getTelefonofijoacudiente()
    {
        return $this->telefonofijoacudiente;
    }

    /**
     * Set telefonocelularacudiente
     *
     * @param string $telefonocelularacudiente
     * @return Estudiantepreicfes
     */
    public function setTelefonocelularacudiente($telefonocelularacudiente)
    {
        $this->telefonocelularacudiente = $telefonocelularacudiente;

        return $this;
    }

    /**
     * Get telefonocelularacudiente
     *
     * @return string 
     */
    public function getTelefonocelularacudiente()
    {
        return $this->telefonocelularacudiente;
    }

    /**
     * Set nombrearchivo
     *
     * @param string $nombrearchivo
     * @return Estudiantepreicfes
     */
    public function setNombrearchivo($nombrearchivo)
    {
        $this->nombrearchivo = $nombrearchivo;

        return $this;
    }

    /**
     * Get nombrearchivo
     *
     * @return string 
     */
    public function getNombrearchivo()
    {
        return $this->nombrearchivo;
    }

    /**
     * Set rutaarchivo
     *
     * @param string $rutaarchivo
     * @return Estudiantepreicfes
     */
    public function setRutaarchivo($rutaarchivo)
    {
        $this->rutaarchivo = $rutaarchivo;

        return $this;
    }

    /**
     * Get rutaarchivo
     *
     * @return string 
     */
    public function getRutaarchivo()
    {
        return $this->rutaarchivo;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Estudiantepreicfes
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set usuario
     *
     * @param \Fundeuis\FrontalBundle\Entity\Usuario $usuario
     * @return Estudiantepreicfes
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

    /**
     * Set conocimientocursos
     *
     * @param \Fundeuis\FrontalBundle\Entity\Conocimientocursos $conocimientocursos
     * @return Estudiantepreicfes
     */
    public function setConocimientocursos(\Fundeuis\FrontalBundle\Entity\Conocimientocursos $conocimientocursos = null)
    {
        $this->conocimientocursos = $conocimientocursos;

        return $this;
    }

    /**
     * Get conocimientocursos
     *
     * @return \Fundeuis\FrontalBundle\Entity\Conocimientocursos 
     */
    public function getConocimientocursos()
    {
        return $this->conocimientocursos;
    }

    /**
     * Set colegio
     *
     * @param \Fundeuis\FrontalBundle\Entity\Colegio $colegio
     * @return Estudiantepreicfes
     */
    public function setColegio(\Fundeuis\FrontalBundle\Entity\Colegio $colegio = null)
    {
        $this->colegio = $colegio;

        return $this;
    }

    /**
     * Get colegio
     *
     * @return \Fundeuis\FrontalBundle\Entity\Colegio 
     */
    public function getColegio()
    {
        return $this->colegio;
    }

    /**
     * Set universidad
     *
     * @param \Fundeuis\FrontalBundle\Entity\Universidad $universidad
     * @return Estudiantepreicfes
     */
    public function setUniversidad(\Fundeuis\FrontalBundle\Entity\Universidad $universidad = null)
    {
        $this->universidad = $universidad;

        return $this;
    }

    /**
     * Get universidad
     *
     * @return \Fundeuis\FrontalBundle\Entity\Universidad 
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }
}

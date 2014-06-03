<?php

namespace Fundeuis\FrontalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="user_UNIQUE", columns={"user"})}, indexes={@ORM\Index(name="Usuario_Ciudad_idx", columns={"ciudad"}), @ORM\Index(name="Usuario_TipoDocumentoIdentidad_idx", columns={"tipoDocumentoIdentidad"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDocumentoIdentidad", type="string", length=15, nullable=true)
     */
    private $numerodocumentoidentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="primerNombre", type="string", length=45, nullable=false)
     */
    private $primernombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombre", type="string", length=45, nullable=true)
     */
    private $segundonombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellido", type="string", length=45, nullable=false)
     */
    private $primerapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellido", type="string", length=45, nullable=false)
     */
    private $segundoapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijo", type="string", length=15, nullable=true)
     */
    private $telefonofijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoCelular", type="string", length=15, nullable=true)
     */
    private $telefonocelular;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

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
     * @var \Tipodocumentoidentidad
     *
     * @ORM\ManyToOne(targetEntity="Tipodocumentoidentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoDocumentoIdentidad", referencedColumnName="idtipoDocumentoIdentidad")
     * })
     */
    private $tipodocumentoidentidad;



    /**
     * Get idusuario
     *
     * @return integer 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set numerodocumentoidentidad
     *
     * @param string $numerodocumentoidentidad
     * @return Usuario
     */
    public function setNumerodocumentoidentidad($numerodocumentoidentidad)
    {
        $this->numerodocumentoidentidad = $numerodocumentoidentidad;

        return $this;
    }

    /**
     * Get numerodocumentoidentidad
     *
     * @return string 
     */
    public function getNumerodocumentoidentidad()
    {
        return $this->numerodocumentoidentidad;
    }

    /**
     * Set primernombre
     *
     * @param string $primernombre
     * @return Usuario
     */
    public function setPrimernombre($primernombre)
    {
        $this->primernombre = $primernombre;

        return $this;
    }

    /**
     * Get primernombre
     *
     * @return string 
     */
    public function getPrimernombre()
    {
        return $this->primernombre;
    }

    /**
     * Set segundonombre
     *
     * @param string $segundonombre
     * @return Usuario
     */
    public function setSegundonombre($segundonombre)
    {
        $this->segundonombre = $segundonombre;

        return $this;
    }

    /**
     * Get segundonombre
     *
     * @return string 
     */
    public function getSegundonombre()
    {
        return $this->segundonombre;
    }

    /**
     * Set primerapellido
     *
     * @param string $primerapellido
     * @return Usuario
     */
    public function setPrimerapellido($primerapellido)
    {
        $this->primerapellido = $primerapellido;

        return $this;
    }

    /**
     * Get primerapellido
     *
     * @return string 
     */
    public function getPrimerapellido()
    {
        return $this->primerapellido;
    }

    /**
     * Set segundoapellido
     *
     * @param string $segundoapellido
     * @return Usuario
     */
    public function setSegundoapellido($segundoapellido)
    {
        $this->segundoapellido = $segundoapellido;

        return $this;
    }

    /**
     * Get segundoapellido
     *
     * @return string 
     */
    public function getSegundoapellido()
    {
        return $this->segundoapellido;
    }

    /**
     * Set telefonofijo
     *
     * @param string $telefonofijo
     * @return Usuario
     */
    public function setTelefonofijo($telefonofijo)
    {
        $this->telefonofijo = $telefonofijo;

        return $this;
    }

    /**
     * Get telefonofijo
     *
     * @return string 
     */
    public function getTelefonofijo()
    {
        return $this->telefonofijo;
    }

    /**
     * Set telefonocelular
     *
     * @param string $telefonocelular
     * @return Usuario
     */
    public function setTelefonocelular($telefonocelular)
    {
        $this->telefonocelular = $telefonocelular;

        return $this;
    }

    /**
     * Get telefonocelular
     *
     * @return string 
     */
    public function getTelefonocelular()
    {
        return $this->telefonocelular;
    }

    /**
     * Set user
     *
     * @param \Fundeuis\FrontalBundle\Entity\User $user
     * @return Usuario
     */
    public function setUser(\Fundeuis\FrontalBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Fundeuis\FrontalBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ciudad
     *
     * @param \Fundeuis\FrontalBundle\Entity\Ciudad $ciudad
     * @return Usuario
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

    /**
     * Set tipodocumentoidentidad
     *
     * @param \Fundeuis\FrontalBundle\Entity\Tipodocumentoidentidad $tipodocumentoidentidad
     * @return Usuario
     */
    public function setTipodocumentoidentidad(\Fundeuis\FrontalBundle\Entity\Tipodocumentoidentidad $tipodocumentoidentidad = null)
    {
        $this->tipodocumentoidentidad = $tipodocumentoidentidad;

        return $this;
    }

    /**
     * Get tipodocumentoidentidad
     *
     * @return \Fundeuis\FrontalBundle\Entity\Tipodocumentoidentidad 
     */
    public function getTipodocumentoidentidad()
    {
        return $this->tipodocumentoidentidad;
    }
}

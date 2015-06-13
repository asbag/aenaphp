<?php

namespace Aena\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Billete
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Billete
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codgo", type="string", length=255)
     */
    private $codgo;

    /**
     * @var string
     *
     * @ORM\Column(name="asiento", type="string", length=255)
     */
    private $asiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;


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
     * Set codgo
     *
     * @param string $codgo
     * @return Billete
     */
    public function setCodgo($codgo)
    {
        $this->codgo = $codgo;

        return $this;
    }

    /**
     * Get codgo
     *
     * @return string 
     */
    public function getCodgo()
    {
        return $this->codgo;
    }

    /**
     * Set asiento
     *
     * @param string $asiento
     * @return Billete
     */
    public function setAsiento($asiento)
    {
        $this->asiento = $asiento;

        return $this;
    }

    /**
     * Get asiento
     *
     * @return string 
     */
    public function getAsiento()
    {
        return $this->asiento;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Billete
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Billete
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
}

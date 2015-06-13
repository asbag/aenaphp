<?php

namespace Aena\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Avion
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
     * @ORM\Column(name="modelo", type="string", length=255)
     */
    private $modelo;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_pasajeros", type="integer")
     */
    private $maxPasajeros;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_salida", type="datetime")
     */
    private $horaSalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_llegada", type="datetime")
     */
    private $horaLlegada;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_licencia", type="string", length=255)
     */
    private $codigoLicencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_licencia", type="boolean")
     */
    private $estadoLicencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="caducidad_licencia", type="datetime")
     */
    private $caducidadLicencia;


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
     * Set modelo
     *
     * @param string $modelo
     * @return Avion
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set maxPasajeros
     *
     * @param integer $maxPasajeros
     * @return Avion
     */
    public function setMaxPasajeros($maxPasajeros)
    {
        $this->maxPasajeros = $maxPasajeros;

        return $this;
    }

    /**
     * Get maxPasajeros
     *
     * @return integer 
     */
    public function getMaxPasajeros()
    {
        return $this->maxPasajeros;
    }

    /**
     * Set horaSalida
     *
     * @param \DateTime $horaSalida
     * @return Avion
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    /**
     * Get horaSalida
     *
     * @return \DateTime 
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * Set horaLlegada
     *
     * @param \DateTime $horaLlegada
     * @return Avion
     */
    public function setHoraLlegada($horaLlegada)
    {
        $this->horaLlegada = $horaLlegada;

        return $this;
    }

    /**
     * Get horaLlegada
     *
     * @return \DateTime 
     */
    public function getHoraLlegada()
    {
        return $this->horaLlegada;
    }

    /**
     * Set codigoLicencia
     *
     * @param string $codigoLicencia
     * @return Avion
     */
    public function setCodigoLicencia($codigoLicencia)
    {
        $this->codigoLicencia = $codigoLicencia;

        return $this;
    }

    /**
     * Get codigoLicencia
     *
     * @return string 
     */
    public function getCodigoLicencia()
    {
        return $this->codigoLicencia;
    }

    /**
     * Set estadoLicencia
     *
     * @param boolean $estadoLicencia
     * @return Avion
     */
    public function setEstadoLicencia($estadoLicencia)
    {
        $this->estadoLicencia = $estadoLicencia;

        return $this;
    }

    /**
     * Get estadoLicencia
     *
     * @return boolean 
     */
    public function getEstadoLicencia()
    {
        return $this->estadoLicencia;
    }

    /**
     * Set caducidadLicencia
     *
     * @param \DateTime $caducidadLicencia
     * @return Avion
     */
    public function setCaducidadLicencia($caducidadLicencia)
    {
        $this->caducidadLicencia = $caducidadLicencia;

        return $this;
    }

    /**
     * Get caducidadLicencia
     *
     * @return \DateTime 
     */
    public function getCaducidadLicencia()
    {
        return $this->caducidadLicencia;
    }
}

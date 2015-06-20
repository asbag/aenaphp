<?php

namespace Aena\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aeropuerto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aeropuerto
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_puertas", type="integer")
     */
    private $numPuertas;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Aeropuerto
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
     * Set numPuertas
     *
     * @param integer $numPuertas
     * @return Aeropuerto
     */
    public function setNumPuertas($numPuertas)
    {
        $this->numPuertas = $numPuertas;

        return $this;
    }

    /**
     * Get numPuertas
     *
     * @return integer 
     */
    public function getNumPuertas()
    {
        return $this->numPuertas;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Aeropuerto
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }
}

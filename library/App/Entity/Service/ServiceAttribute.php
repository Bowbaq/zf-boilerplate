<?php

namespace App\Entity\Service;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Service\ServiceAttributeRepository")
 * @ORM\Table(name="service_attributes")
 */
class ServiceAttribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer $id
     */ 
 	protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceType", inversedBy="attributes")
     */
	protected $service_type;
	
	/**
	 * Le nom de l'attribut
	 * 
	 * @ORM\Column(type="string", length=50, nullable=false)
	 *
	 * @var string $name
	 */
	protected $name;
	
	/**
	 * Le label de l'attribut (potentiellement différent du nom)
	 * 
	 * @ORM\Column(type="string", length=50, nullable=false)
	 *
	 * @var string $label
	 */
	protected $label;
	
	/**
	 * Le type de l'attribut parmis :
	 * - 
	 * - 
	 *
	 * @ORM\Column(type="string", length=50, nullable=false)
	 * 
	 * @var string $type
	 */
	protected $type;
	
	/**
	 * L'attribut est-il optionnel?
	 * 
	 * @ORM\Column(type="boolean", nullable=false)
	 *
	 * @var boolean $optional
	 */
	protected $optional = false;
	
	public static $valid_types = array(
	     'string' => 'Texte',
	     'integer' => 'Nombre',
	     'boolean' => 'Choix',
	);
	
	public function __construct($name, $label, $type, $optional = false) {
	   $this->name = $name;
	   $this->label = $label;
	   $this->type = $type;
	   $this->optional = $optional;
	}

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
     * Set name
     *
     * @param string $name
     * @return ServiceAttribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return ServiceAttribute
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return ServiceAttribute
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set optional
     *
     * @param boolean $optional
     * @return ServiceAttribute
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;
        return $this;
    }

    /**
     * Get optional
     *
     * @return boolean 
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * Set service_type
     *
     * @param Entity\Service\ServiceType $serviceType
     * @return ServiceAttribute
     */
    public function setServiceType(\App\Entity\Service\ServiceType $serviceType = null)
    {
        $this->service_type = $serviceType;
        return $this;
    }

    /**
     * Get service_type
     *
     * @return Entity\Service\ServiceType 
     */
    public function getServiceType()
    {
        return $this->service_type;
    }
}
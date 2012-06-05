<?php

namespace App\Entity\Service;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="service_types")
 */
class ServiceType
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
	 * Le nom du service
	 * 
	 * @ORM\Column(type="string", length=50, unique=true, nullable=false)
	 *
	 * @var string $name
	 */
	protected $name;
	
	/**
	 * Les différents attributs du service
	 * 
	 * @ORM\OneToMany(targetEntity="ServiceAttribute", mappedBy="service_type", cascade={"persist", "remove"})
	 *
	 * @var Doctrine\Common\Collections\ArrayCollection $attributes
	 */
	protected $attributes;
	
	public function __construct($name) {
	    $this->name = $name;
		$this->attributes = new ArrayCollection();
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
     * @return ServiceType
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
     * Add attributes
     *
     * @param App\Entity\Service\ServiceAttribute $attribute
     * @return ServiceType
     */
    public function addServiceAttribute(\App\Entity\Service\ServiceAttribute $attribute)
    {
        foreach($this->attributes as $a) {
            if($a->getName() == $attribute->getName()) {
                // On ne peut pas avoir deux attributs avec le même nom
                return $this;
            }
        }
        $attribute->setServiceType($this);
        $this->attributes[] = $attribute;
        return $this;
    }

    /**
     * Get attributes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
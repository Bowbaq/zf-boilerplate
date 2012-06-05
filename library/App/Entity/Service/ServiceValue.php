<?php

namespace App\Entity\Service;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="service_values")
 */
class ServiceValue
{
	/**
	 * L'instance de service à laquelle cette valeur est rattachée
	 * 
	 * @ORM\Id
	 * @ORM\OneToOne(targetEntity="Service")
	 */
	protected $service;
	
	/**
	 * Le type du service lié
	 *
	 * @ORM\Id
	 * @ORM\OneToOne(targetEntity="ServiceType")
	 */
	protected $type;
	
	/**
	 * L'attribut du service lié
	 *
	 * @ORM\Id
	 * @ORM\OneToOne(targetEntity="ServiceAttribute")
	 */
	protected $attribute;
	
	/**
	 * La valeur de l'attribut
	 *
	 * @ORM\Column(type="string", length=255)
	 * 
	 * @var string $value
	 */
	protected $value;

    /**
     * Set value
     *
     * @param string $value
     * @return ServiceValue
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set service
     *
     * @param Entity\Service\Service $service
     * @return ServiceValue
     */
    public function setService(App\Entity\Service\Service $service = null)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Get service
     *
     * @return Entity\Service\Service 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set type
     *
     * @param Entity\Service\ServiceType $type
     * @return ServiceValue
     */
    public function setType(App\Entity\Service\ServiceType $type = null)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return Entity\Service\ServiceType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set attribute
     *
     * @param Entity\Service\ServiceAttribute $attribute
     * @return ServiceValue
     */
    public function setAttribute(App\Entity\Service\ServiceAttribute $attribute = null)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * Get attribute
     *
     * @return Entity\Service\ServiceAttribute 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
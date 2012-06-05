<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client
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
	 * @ORM\ManyToMany(targetEntity="App\Entity\Service\Service", mappedBy="subscribers")
	 *
	 * @var Doctrine\Common\Collections\ArrayCollection $subscriptions
	 */
	protected $subscriptions;
	
	public function __construct() {
		$this->subscriptions = new ArrayCollection();
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
     * @return Client
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
     * Add subscriptions
     *
     * @param App\Entity\Service\Service $subscriptions
     * @return Client
     */
    public function addService(App\Entity\Service\Service $service)
    {
        $this->subscriptions[] = $service;
        return $this;
    }

    /**
     * Get subscriptions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }
}
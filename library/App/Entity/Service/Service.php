<?php

namespace App\Entity\Service;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="services")
 */
class Service {
	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer $id
     */ 
 	protected $id;

	/**
	 * Le type du service
	 *
	 * @ORM\OneToOne(targetEntity="ServiceType")
	 */
	protected $service_type;

	/**
	 * Les clients qui ont souscris à ce service
	 * 
	 * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="subscriptions")
	 *
	 * @var Doctrine\Common\Collections\ArrayCollection $subscribers
	 */
	protected $subscribers;
	
	public function __construct() {
		$this->subscribers = new ArrayCollection();
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
     * Add subscribers
     *
     * @param App\Entity\Client $subscribers
     * @return Service
     */
    public function addClient(App\Entity\Client $client)
    {
        $this->subscribers[] = $client;
        return $this;
    }

    /**
     * Get subscribers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * Set service_type
     *
     * @param Entity\Service\ServiceType $serviceType
     * @return Service
     */
    public function setServiceType(App\Entity\Service\ServiceType $serviceType = null)
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
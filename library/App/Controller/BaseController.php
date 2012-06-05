<?php

namespace App\Controller;

/**
 * A base controller to extend
 */
class BaseController extends \Zend_Controller_Action {
	/**
     * The dependency injection container
     */
    protected $_sc = null;
	
	/**
	 * The Doctrine handle
	 * 
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em = null;

	/**
	 * The monolog handle
	 *
	 * @var Monolog\Logger
	 * @InjectService logger
	 */
	protected $_log;
	
	public function init()
    {
		$this->_sc = \Zend_Registry::get('sc');
        $this->_em = \Zend_Registry::get('em');
    }
}

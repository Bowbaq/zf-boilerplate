<?php

namespace App\Form\ServiceAttribute;

use App\Entity\Service\ServiceAttribute;

class Add extends \Zend_Form
{
    protected $_service_type;

    public function __construct($service_type = null) {
        $this->_service_type = $service_type;
        parent::__construct();
    }
    
    public function init()
    {
        $this->setMethod(\Zend_Form::METHOD_POST)
            ->setName('addServiceAttribute')
            ->setAction('/admin/service-type/add-attribute');
            
        $this->addElements(array(
            new \Zend_Form_Element_Text('name', array(
                'label' => 'Nom de l\'attribut',
                'required' => true,
                'filters'    => array('StringTrim', 'StringToLower'),
                'validators' => array(
                    'NotEmpty',
                    //TODO: Validateur ne marche pas
                    array('Regex',
                        false,
                        array('/^[a-z][0-9a-z_]{1,}$/')
                    ),
                ),
            )),
            
            new \Zend_Form_Element_Text('label', array(
                'label' => 'Label (affichage utilisateur)',
                'required' => true,
                'filters'    => array('StringTrim'),
                'validators' => array('NotEmpty'),
            )),
            
            new \Zend_Form_Element_Select('type', array(
                'label' => 'Type d\'attribut',
                'required' => true,
                'multiOptions' => ServiceAttribute::$valid_types
            )),
            
            new \Zend_Form_Element_Checkbox('optional', array(
                'label' => 'Attribut optionnel?',
            )),
            
            new \Zend_Form_Element_Hidden('service_type_id', array(
                'value' => ((null !== $this->_service_type) ? $this->_service_type->getId() : null),
            )),

			new \Zend_Form_Element_Submit($this->getName(), array(
				'label' => 'Ajouter',
			)),
        ));
    }
}
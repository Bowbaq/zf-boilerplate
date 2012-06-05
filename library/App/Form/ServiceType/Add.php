<?php

namespace App\Form\ServiceType;

class Add extends \Zend_Form
{
    public function init()
    {
        $this->setMethod(\Zend_Form::METHOD_POST)
            ->setName('addServiceType');
        
        $name = new \Zend_Form_Element_Text('name');
        $submit = new \Zend_Form_Element_Submit($this->getName());
        
        $name->setLabel('Nom du type de service')
            ->setRequired(true)
        ;
        $submit->setLabel('Ajouter');
        
        $this->addElements(
            array($name, $submit)
        );
    }
}
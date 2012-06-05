<?php

use App\Entity\Service\ServiceType;
use App\Entity\Service\ServiceAttribute;

class Admin_ServiceTypeController extends App\Controller\BaseController
{
    public function indexAction()
    {
        $service_types = $this->_em->getRepository('App\Entity\Service\ServiceType');
        $this->view->service_types = $service_types->findAll();
    }
    
    public function showAction()
    {
        $id = $this->_request->getParam('id', null);
        
        if(null !== $id) {
            $er = $this->_em->getRepository('App\Entity\Service\ServiceType');
            
            $service_type = $er->findOneByid($id);
            if(null !== $service_type) {
                $this->view->service_type = $service_type;
                $this->view->add_attribute_form = new App\Form\ServiceAttribute\Add($service_type);
            } else {
                $this->view->error = 'Nous somme désolé mais ce type de service n\'existe pas.';
            }
        } else {
            // Pas d'id dans la requete, on redirige vers la liste des types de services
            $this->_redirect('/admin/service-type/');
        }
    }
    
    public function addAction()
    {
        $form = new App\Form\ServiceType\Add;
        $data = $this->_request->getPost();      
        
        if($this->_request->isPost() && isset($data[$form->getName()]) && $form->isValid($data)) {
            // Le formulaire est valide
            $er = $this->_em->getRepository('App\Entity\Service\ServiceType');
            
            if(count($er->findByName($data['name'])) > 0) {
                // TODO: @Maxime je ne sais pas encore faire les messages d'erreur ...
                $this->view->error = 'Ce type de service (' . $data['name'] . ') existe déjà ... choisissez en un autre!';
                // Reset the form
                $form->reset();
                $this->view->form = $form;
                return;
            } else {
                $service_type = new ServiceType($data['name']);
                $this->_em->persist($service_type);
                $this->_em->flush();
                
                $this->_redirect('/admin/service-type/');
            }
        } else {
            $this->view->form = $form;
        }
    }
    
    public function editAction()
    {
        $id = $this->_request->getParam('id', null);
        
        if(null !== $id) {
            $er = $this->_em->getRepository('App\Entity\Service\ServiceType');       
            $service_type = $er->findOneByid($id);
            
            if(null !== $service_type) {
                // TODO: Edit 
            } else {
                $this->view->error = 'Nous somme désolé mais ce type de service n\'existe pas.';
            }
        } else {
            // Pas d'id dans la requete, on redirige vers la liste des types de services
            $this->_redirect('/admin/service-type/');
        }
    }
    
    public function addAttributeAction()
    {
        $data = $this->_request->getPost();
        $service_type_id = $this->_request->getParam('service_type_id', null);
        $form = new App\Form\ServiceAttribute\Add;
        
        if($this->_request->isPost() && isset($data[$form->getName()]) && ($valid = $form->isValid($data))) {
            $er = $this->_em->getRepository('App\Entity\Service\ServiceType');
            $service_type = $er->findOneByid($service_type_id);
            
            if(null !== $service_type) {
                $service_type->addServiceAttribute(
                    new ServiceAttribute(
                        $data['name'],
                        $data['label'],
                        $data['type'],
                        $data['optional']
                    )
                );
                $this->_em->persist($service_type);
                $this->_em->flush();
            } else {
            }
        }
        
        if(null !== $service_type_id) {
            $this->_redirect('/admin/service-type/show/id/' . $service_type_id);
        } else {
            $this->_redirect('/admin/service-type/');
        }
    }
    
    public function removeAttributeAction()
    {
        $service_type_id = $this->_request->getParam('id', null);
        $attribute_id = $this->_request->getParam('attribute_id', null);
        
        if(null !== $service_type_id && null !== $attribute_id) {
            $er = $this->_em->getRepository('App\Entity\Service\ServiceType');
            $service_type = $er->findOneByid($service_type_id);
            
            if(null !== $service_type) {
                foreach($service_type->getAttributes() as $a) {
                    if($attribute_id == $a->getId()) {
                        // Suppression de l'attribut et de toutes les valeurs associées
                        $this->_em->getRepository('App\Entity\Service\ServiceAttribute')
                            ->removeAttributeAndValues($a);
                        $this->_redirect('/admin/service-type/show/id/' . $service_type_id);
                    }
                }
                // Aucun attribut correspondant à attribute_id n'a été trouvé
                $this->view->error = 'Le type de service ' . $service_type->getName() . ' n\'a pas d\'attribut avec l\'id '. $attribute_id;
            } else {
                $this->view->error = 'Nous somme désolé mais ce type de service n\'existe pas.';
            }
        }
        
        if(null !== $service_type_id) {
            $this->_redirect('/admin/service-type/show/id/' . $service_type_id);
        } else {
            $this->_redirect('/admin/service-type/');
        }
    }
}
<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Sonata\MediaBundle\Controller\MediaController;

class ImageTypeExtension extends AbstractTypeExtension{
    
    public static function getExtendedTypes(): iterable{
        return [FileType::class];
    }

    public function buildView(FormView $view, FormInterface $form,  array $options){
        
        
        if ($form->getParent()->getParent()!== null){
            $parentData = $form->getParent()->getParent()->getData();

            // check if there is an uploaded image
            if ($parentData !== null){
    
                // if the data submited show uploaded images 
                if ($parentData->getId() !== null) {                 
                    $view->vars['media'] = $parentData->getMedia();
                    //dump($view);
                } 
            }
        }
       
        
    }
}
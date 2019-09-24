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
        $parentData = $form->getParent()->getData();
        //dump(getenv(APP_TEST));
        // check if there is an uploaded image
        dump($parentData);
        if ($parentData !== null){

            // if the data submited show uploaded images 
            if ($parentData->getId() !== null) {                 
                $view->vars['imageName'] = $parentData->getproviderReference();
                $view->vars['media'] = $parentData;
            } 
        }
        
    }
}
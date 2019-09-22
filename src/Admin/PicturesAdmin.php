<?php

namespace App\Admin;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Sonata\AdminBundle\Admin\AbstractAdmin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

final class PicturesAdmin extends AbstractAdmin
{
    // which field appears on the form 
    protected function configureFormFields(FormMapper $formMApper)
    {

        $formMApper
                ->add('media', MediaType::class,[
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'default',
                    ]);
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper ->add('media');
    }
    
    Protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper ->add('media');
    }
}
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

final class UserAdmin extends AbstractAdmin
{
    // which field appears on the form 
    protected function configureFormFields(FormMapper $formMApper)
    {
        $formMApper
                ->add('username', TextType::class)
                ->add('email', TextType::class)
                ->add('enabled', BooleanType::class)
                ->add('last_login', DateType::class);
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper ->add('username');
    }
    
    Protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper ->add('media');
    }
}
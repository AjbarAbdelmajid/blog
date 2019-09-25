<?php

namespace App\Admin;

use App\Entity\Category;
use App\Application\Sonata\MediaBundle\Entity\Media;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Sonata\AdminBundle\Form\Type\ModelHiddenType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use FOS\CKEditorBundle\Form\Type\CKEditorType;


final class ArticleAdmin extends AbstractAdmin
{
    // which field appears on the form 
    protected function configureFormFields(FormMapper $formMApper)
    {
        $Collectiondetails = ['edit' => 'inline','sortable' => 'pos', 'inline' => 'table',];
        $formMApper
            ->with('Content')
                ->add('title', TextType::class)
                ->add('body', CKEditorType::class, ['auto_inline' => false])
                ->add('paragraphs', CollectionType::class, ['by_reference'=> false], $Collectiondetails)
                ->add('pictures', CollectionType::class, ['by_reference'=> false], $Collectiondetails)
            ->end()
            ->with('Related Content')
                ->add('category', ModelType::class)
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper 
                ->add('title')
                ->add('category');
    }
    
    Protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->add('body','html')
                ->add('category');
    }
}
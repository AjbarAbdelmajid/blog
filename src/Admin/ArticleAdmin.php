<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Sonata\MediaBundle\Form\Type\MediaType;

use FOS\CKEditorBundle\Form\Type\CKEditorType;

final class ArticleAdmin extends AbstractAdmin
{
    // which field appears on the form 
    protected function configureFormFields(FormMapper $formMApper)
    {
        $formMApper
            ->with('Content')
                ->add('title', TextType::class)
                ->add('body', CKEditorType::class)
                ->add('paragraphs', CollectionType::class, array('by_reference'=> false),
                    array(
                        'edit' => 'inline',
                        'sortable' => 'pos',
                        'inline' => 'table',
                        )
                    )
            ->end()
            ->with('upload image')
                ->add('media', MediaType::class,array(
                    'provider' => 'sonata.media.provider.image',
                     'context'  => 'default',
                     'label' => 'Image',
                     'required'   =>  false,
                    ))
            ->end()
            ->with('Related Content')
                ->add('category', ModelType::class,[
                    'class' => Category::class,
                    'property' => 'name',
                    ])
            ->end();
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper -> add('title')
        ->add('category');
    }
    
    Protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->add('body')
                ->add('category');
    }
}
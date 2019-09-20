<?php

namespace App\Admin;

use App\Entity\Category;
use App\Application\Sonata\MediaBundle\Entity\Media;
use Sonata\AdminBundle\Admin\AbstractAdmin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
                ->add('pictures', CollectionType::class, array('by_reference'=> false),
                    array(
                        'help' => 'klgjdfg',
                        'edit' => 'inline',
                        'sortable' => 'pos',
                        'inline' => 'table',
                        )
                    )
            ->end()
            
            ->with('Related Content')
                ->add('category', ModelType::class)
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
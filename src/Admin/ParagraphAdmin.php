<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

final class ParagraphAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('content', CKEditorType::class);
    }
    protected function configureDatagridFilter(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('content');
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('content');
    }
} 
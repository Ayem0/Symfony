<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; 
use App\Entity\Books;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
class BooksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Books::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            idField::new('id'),
            TextField::new('title'), 
            AssociationField::new('authors')
                ->SetFormTypeOptions([
                    'by_reference'=> FALSE,
                ]),

            AssociationField::new('mainCategory')
                ->SetFormTypeOptions([
                    'by_reference'=> FALSE,
                ]),
            TextField::new('note'),
            TextField::new('isbn'),
            TextField::new('published_date'),
            TextEditorField::new('description'),
        ];
    }
}
<?php

namespace App\Controller\Admin;

use App\Entity\BooksNotes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; 

class BooksNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BooksNotes::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('note'),
            TextField::new('date'),
            AssociationField::new('id_users')
                ->SetFormTypeOptions([
                    'by_reference'=> FALSE,
                ]),
            AssociationField::new('id_books')
                ->SetFormTypeOptions([
                    'by_reference'=> FALSE,
                ]),
        ];
    }

}

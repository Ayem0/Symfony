<?php

namespace App\Controller\Admin;

use App\Entity\BooksNotes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BooksNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BooksNotes::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

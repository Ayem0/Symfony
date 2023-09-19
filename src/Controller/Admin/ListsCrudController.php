<?php

namespace App\Controller\Admin;

use App\Entity\Lists;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ListsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lists::class;
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

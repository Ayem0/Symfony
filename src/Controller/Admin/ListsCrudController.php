<?php

namespace App\Controller\Admin;

use App\Entity\Lists;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ListsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lists::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            AssociationField::new('id_user')
            ->SetFormTypeOptions([
                'by_reference'=> FALSE,
            ]),
        ];
    }
}

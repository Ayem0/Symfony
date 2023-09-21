<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField; 

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('email'),
            TextField::new('username'),
            TextField::new('password'),
            DateField::new('created_at'),
        ];
    }
}

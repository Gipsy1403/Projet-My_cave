<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RegionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Region::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
		TextField::new("name")
		->setFormTypeOptions([
			"label"=>"nom"
	   ]),
		AssociationField::new('country', "Pays")
		->setFormTypeOptions([
			"choice_label" =>"name",
			"label"=>"nom",
		])
        ];
    }
    
}

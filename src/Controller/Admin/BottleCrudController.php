<?php

namespace App\Controller\Admin;

use App\Entity\Bottle;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class BottleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bottle::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
		TextField::new('name', 'Nom du Domaine'),
		TextEditorField::new('description'),
		NumberField::new('year','Millésime'),
		AssociationField::new('region','Région'),
		// ->setFormTypeOptions([  'by_reference' => false,
		// 					'multiple' => true,
		// 					'choice_label' => 'name',
		// 				]),
		AssociationField::new('grapes','Cépages')
		->setFormTypeOptions([  'by_reference' => false,
							'multiple' => true,
							'choice_label' => 'name',
						]),
		
        ];
    }
    
}

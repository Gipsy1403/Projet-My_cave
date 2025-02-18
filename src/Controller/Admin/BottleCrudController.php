<?php

namespace App\Controller\Admin;

use App\Entity\Bottle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
		AssociationField::new('region','Région')
		->setFormTypeOptions([  
							'choice_label' => 'name',
						]),
		AssociationField::new('grapes','Cépages')
		->setFormTypeOptions([  	'by_reference' => false,
							'multiple' => true,
							'choice_label' => 'name',
						]),
		TextEditorField::new('description'),
		NumberField::new('year','Millésime'),


		ImageField::new('imageName')
		->setBasePath('images/')
		->setUploadDir('public/images/')
		->setRequired(false),

		TextField::new ("imageFile","Images")
		->setFormType(VichImageType::class)
		->onlyOnForms(),
		
        ];
    }

}

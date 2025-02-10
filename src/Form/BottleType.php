<?php

namespace App\Form;

use App\Entity\Bottle;
use App\Entity\Grapes;
use App\Entity\Region;
use App\Entity\Country;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BottleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          	->add('name', TextType::class,[
				"label"=>"Nom du Domaine"
		  	])
			->add('year', NumberType::class,[
				"label"=>"Millésime",
				"attr"=>[
					"minmax" =>4,
					// "max"=>4,
					// "placeHolder"=>"Saisir l'année (YYYY)."
				]
			])
			  ->add('grapes', EntityType::class, [
			     'class' => Grapes::class,
				'choice_label' => 'name',
				"label"=>"Cépage(s)",
				'multiple' => true,
				"expanded" => false,
			  ])
          	->add('region', EntityType::class, [
				'class' => region::class,
				'choice_label' => 'name',
				'label' => 'Région',
				"multiple"=> false,
			])
			->add('description',TextareaType::class,[
				"label"=>"Description",
			])
			->add('country', EntityType::class, [
				'class' => Country::class,
				'choice_label' => 'name',
				'label'=>"Pays",
				"mapped"=>false,
				"multiple"=>false,
			])
		  ->add('imageFile', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image",
			'constraints' => [
			    new File([
				   'maxSize' => '2M',
				   'mimeTypes' => [
					  'image/jpeg',
					  'image/jpg',
					  'image/png',
					  'image/webp',
				   ],
				   'mimeTypesMessage' => 'Veuillez télécharger un fichier au format JPEG, JPG, PNG ou WEBP.'
			    ])
			]
		 ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bottle::class,
        ]);
    }
}

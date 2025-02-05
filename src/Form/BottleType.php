<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Bottle;
use App\Entity\Cellar;
use App\Entity\Grapes;
use App\Entity\Region;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class BottleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('description')
            ->add('imageName')
            ->add('updatedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('year')
            ->add('region', EntityType::class, [
                'class' => Region::class,
'choice_label' => 'id',
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
'choice_label' => 'id',
            ])
            ->add('cellar', EntityType::class, [
                'class' => Cellar::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('grapes', EntityType::class, [
                'class' => Grapes::class,
'choice_label' => 'id',
'multiple' => true,
            ])
		  ->add('imageFile', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image",
			'constraints' => [
			    new File([
				   'maxSize' => '2M', //Ajout de contrainte (Optionnel)
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

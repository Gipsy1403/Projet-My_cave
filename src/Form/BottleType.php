<?php

namespace App\Form;

use App\Entity\Bottle;
use App\Entity\Grapes;
use App\Entity\Region;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
			// ->add('grapes', TextType::class, [
			// 	'label' => 'Cépage',
			// ])
			->add('year', TextType::class,[
				"label"=>"Millésime",
				"attr"=>[
					"type"=>"number",
					"max"=>4,
					"placeHolder"=>"Saisir l'année (YYYY)."
				]

			])
          	->add('region', EntityType::class, [
				'class' => region::class,
				'choice_label' => 'name',
				'label' => 'Région',
			])
			->add('description',TextareaType::class,[
				"label"=>"Description"
			])
          //    ->add('country', EntityType::class, [
		// 		'class' => Country::class,
		// 		'choice_label' => 'country',
		// 		'label'=>"Pays",
		// 		// 'placeholder' => 'Sélectionner un pays',
		// 		'mapped' => false, // On ne lie pas directement le pays à Bottle, juste au formulaire
		// 		'query_builder' => function (EntityRepository $repository) use ($builder) {
		// 		// Sélectionner les pays en fonction de la région choisie
		// 		$region = $builder->getData()->getRegion(); // Récupérer la région sélectionnée
		// 		if ($region) {
		// 			return $repository->createQueryBuilder('c')
		// 				->innerJoin('c.region', 'r')
		// 				->where('r.id = :regionid')
		// 				->setParameter('regionid', $region->getRegion());
		// 		} else {
		// 			return $repository->createQueryBuilder('c'); // Si aucune région n'est sélectionnée, afficher tous les pays
		// 		}
		// 		},
		//    ])
 
          //   ->add('grapes', EntityType::class, [
          //      'class' => Grapes::class,
		// 	'choice_label' => 'id',
		// 	"label"=>"Cépage",
		// 	'multiple' => false,
          //   ])
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

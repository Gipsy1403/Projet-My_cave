<?php

namespace App\Form;

use App\Entity\Bottle;
use App\Entity\Cellar;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBottleCellarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
	   ->add('cellar', EntityType::class, [
		'class' => Cellar::class,
		'choices' => $options['cellars'], // Liste des caves de l'utilisateur
		'choice_label' => 'name', // Affiche le nom de la cave
		'placeholder' => 'Choisissez votre cave',
	 ]);
//        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
          //   'data_class' => Cellar::class,
		"cellar"=>[],
        ]);
    }
}

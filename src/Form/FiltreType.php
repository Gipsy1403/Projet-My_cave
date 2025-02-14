<?php

namespace App\Form;

use App\Entity\Bottle;
use App\Entity\Cellar;
use App\Entity\Grapes;
use App\Entity\Region;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
		// ->add('name',EntityType::class,[
		// 	'class' => Bottle::class,
		// 	'choice_label' => 'name',
		// 	'placeholder' => 'Toute',
		// 	'required' => false,
		// ])
		// ->add('description')
		// ->add('imageName')
		// ->add('updatedAt', null, [
		// 	'widget' => 'single_text'
		// ])
		// ->add('year',DateType::class,[
		// 	// 'required' => false,
		// 	// 'multiple' => false,
		// 	"label"=>"Millésimes",
		// 	"format"=>"yyyy",
		// 	"required"=>false,
			

		// ])
		->add('region', EntityType::class, [
			'class' => Region::class,
			'choice_label' => 'name',
			'multiple' => false,
			"expanded"=>false,
			"label"=>"Régions",
			"required"=>false,


		])
		// ->add('cellar', EntityType::class, [
		// 	'class' => Cellar::class,
		// 	'choice_label' => 'name',
		// 	'multiple' => true,
		// 	"label"=>"Cave",

		// ])
		->add('grapes', EntityType::class, [
			'class' => Grapes::class,
			'choice_label' => 'name',
			'multiple' => true,
			"expanded"=>false,
			"label"=>"Cépages",
			"required"=>false,


		])
		->add('country', EntityType::class, [
			'class' => Country::class,
			'choice_label' => 'name',
			'label'=>"Pays",
			"mapped"=>false,
			"multiple"=>false,
			"required"=>false,

		])
	;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
          //   'data_class' => Bottle::class,
		'method' => 'GET',
          'csrf_protection' => false
        ]);
    }
}

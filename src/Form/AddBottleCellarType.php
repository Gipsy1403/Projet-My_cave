<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Bottle;
use App\Entity\Cellar;
use App\Repository\CellarRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AddBottleCellarType extends AbstractType
{
	// fonction privée qui stocke un seervice permettant d'accéder à l'utilisateur connecté
	private TokenStorageInterface  $tokenStorage;

	public function __construct(TokenStorageInterface  $tokenStorage)
	{
		// stocke l'instance TokenStorageInterface dans la propriété $tokenStorage pour l'utiliser plus tard
	    $this->tokenStorage  = $tokenStorage;
	}
	
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
	   ->add('cellar', EntityType::class, [
		'class' => Cellar::class,
		'choice_label' => 'name', // Affiche le nom de la cave
		'label' => 'Choisissez votre cave',
		"multiple"=>false,
		"expanded"=>false,
		'query_builder' => function (CellarRepository $cellarRepository){
			// récupère l'utilisateur connecté grace à TokenStorageInterface . ?-> est utilisé pour éviter une erreur si aucun utilisateur n'est connecté
			$user = $this->tokenStorage->getToken()?->getUser();
			return $cellarRepository->createQueryBuilder('c')
			// récupère les caves de l'utilisateur
			->join("c.user",'u')
			// récupère que les caves de l'utilisateur connecté
			->andwhere('u.id = :id') 
			->setParameter('id', $user->getId());
		}
	]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
          //   'data_class' => Cellar::class,
		// "cellar"=>[],
		"user" => null,
        ]);
    }
}

<?php
#src/Cmi\ApiBundle\/Controller/FamillePathologieController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\Famille_pathologieType;
use Cmi\ApiBundle\Entity\Famille_pathologie;

class FamillePathologieController extends FOSRestController
{
	/*
	*@Rest\View(serializerGroups={"fam_pathologie"})
	*@Rest\Get("/famille_pathologies/afficher")
	*/
	public function afficherFamille_pathologieAction(Request $request)
	{
		$famille_pathos = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Famille_pathologie')
			->findAll();

			/* @var $famille_pathos Famille_pathologie[] */

			$formatted = [];
			foreach ($famille_pathos as $famille_patho) {
				# code...
				$formatted[] = [
					'fam_patho_id' => $famille_patho->getFamPathoId(),
					'fam_patho_code' => $famille_patho->getFamPathoCode(),
					'fam_patho_libelle' => $famille_patho->getFamPathoLibelle(),
					'fam_patho_date_enreg' => $famille_patho->getFamPathoDateEnreg(),
					'fam_patho_date_modif' => $famille_patho->getFamPathoDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/famille_pathologies/rechercher/{fam_patho_id}")
	*/

	public function rechercherFamille_pathologieAction(Request $request)
	{
		$famille_patho = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Famille_pathologie')
				->find($request->get('id'));

		/* @var $famille_patho Famille_pathologie */
		if (empty($famille_patho)) {
			# code...
			return new JsonResponse(['message'=>'Famille de pathologie inexistante'], Response::HTTP_NOT_FOUND);
		}

		$formatted = [
			'fam_patho_id' => $famille_patho->getFamPathoId(),
			'fam_patho_code' => $famille_patho->getFamPathoCode(),
			'fam_patho_libelle' => $famille_patho->getFamPathoLibelle(),
			'fam_patho_date_enreg' => $famille_patho->getFamPathoDateEnreg(),
			'fam_patho_date_modif' => $famille_patho->getFamPathoDateModif(),
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/famille_pathologies/creer")
     */
	public function creerFamille_pathologieAction(Request $request)
	{
		$famille = new Famille_pathologie();

		$famille->setFamPathoDateEnreg(new \DateTime("now"));
		$famille->setFamPathoDateModif(new \DateTime("now"));

		$form = $this->createForm(Famille_pathologieType::class, $famille);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($famille);
			$em->flush();
			return $famille;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/famille_pathologies/supprimer/{fam_patho_id}")
     */
    public function supprimerFamille_pathologieAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $famille = $em->getRepository('Cmi\ApiBundle\:Famille_pathologie')
                    ->find($request->get('fam_patho_id'));
        /* @var $famille Famille_pathologie */

       if($famille){
	       	$em->remove($famille);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/famille_pathologies/modifier/{fam_patho_id}")
    */

    public function modifierFamille_pathologieAction(Request $request)
    {
        return $this->modifierFamille_pathologie($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/famille_pathologies/modifier/{fam_patho_id}")
     */
    public function patchFamille_pathologieAction(Request $request)
    {
        return $this->modifierFamille_pathologie($request, false);
    }

    public function modifierFamille_pathologie(Request $request, $clearMissing)
    {
    	$famille = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Famille_pathologie')
                ->find($request->get('fam_patho_id')); // L'identifiant en tant que paramètre n'est plus nécessaire
       

        if (empty($famille)) {
            return new JsonResponse(['message' => 'Famille de pathologie inexistante'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Famille_pathologieType::class, $famille);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($famille);
            $em->flush();
            return $famille;
        } else {
            return $form;
        }
	    
    }
}
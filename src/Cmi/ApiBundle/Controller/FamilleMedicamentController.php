<?php
#src/Cmi\ApiBundle\/Controller/FamilleMedicamentController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\Famille_medicamentType;
use Cmi\ApiBundle\Entity\Famille_medicament;

class FamilleMedicamentController extends FOSRestController
{
	/*
	*@Rest\View(serializerGroups={"fam_medicament"})
	*@Rest\Get("/famille_medicaments/afficher")
	*/
	public function afficherFamille_medicamentAction(Request $request)
	{
		$famille_medicaments = $this->get("doctrine.orm.entity_manager")
			->getRepository('CmiApiBundle::Famille_medicament')
			->findAll();

			/* @var $famille_medicaments Famille_medicament[] */

			$formatted = [];
			foreach ($famille_medicaments as $famille_medicament) {
				# code...
				$formatted[] = [
					'fam_medic_id' => $famille_medicament->getFamMedicId(),
					'fam_medic_code' => $famille_medicament->getFamMedicCode(),
					'fam_medic_libelle' => $famille_medicament->getFamMedicLibelle(),
					'fam_medic_date_enreg' => $famille_medicament->getFamMedicDateEnreg(),
					'fam_medic_date_modif' => $famille_medicament->getFamMedicDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/famille_medicaments/rechercher/{fam_medic_id}")
	*/

	public function rechercherFamille_medicamentAction(Request $request)
	{
		$famille_medicament = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Famille_medicament')
				->find($request->get('id'));

		/* @var $famille_medicament Famille_medicament */
		if (empty($famille_medicament)) {
			# code...
			return new JsonResponse(['message'=>'Famille de medicament inexistante'], Response::HTTP_NOT_FOUND);
		}

		$formatted[] = [
			'fam_medic_id' => $famille_medicament->getFamMedicId(),
			'fam_medic_code' => $famille_medicament->getFamMedicCode(),
			'fam_medic_libelle' => $famille_medicament->getFamMedicLibelle(),
			'fam_medic_date_enreg' => $famille_medicament->getFamMedicDateEnreg(),
			'fam_medic_date_modif' => $famille_medicament->getFamMedicDateModif()
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/famille_medicaments/creer")
     */
	public function creerFamille_medicamentAction(Request $request)
	{
		$famille = new Famille_medicament();

		$famille->setFamMedicDateEnreg(new \DateTime("now"));
		$famille->setFamMedicDateModif(new \DateTime("now"));

		$form = $this->createForm(Famille_medicamentType::class, $famille);

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
     * @Rest\Delete("/famille_medicaments/supprimer/{fam_medic_id}")
     */
    public function supprimerFamille_medicamentAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $famille = $em->getRepository('Cmi\ApiBundle\:Famille_medicament')
                    ->find($request->get('fam_medic_id'));
        /* @var $famille Famille_medicament */

       if($famille){
	       	$em->remove($famille);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/famille_medicaments/modifier/{fam_medic_id}")
    */

    public function modifierFamille_medicamentAction(Request $request)
    {
        return $this->modifierFamille_medicament($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/famille_medicaments/modifier/{fam_medic_id}")
     */
    public function patchFamille_medicamentAction(Request $request)
    {
        return $this->modifierFamille_medicament($request, false);
    }

    public function modifierFamille_medicament(Request $request, $clearMissing)
    {
    	$famille = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Famille_medicament')
                ->find($request->get('fam_medic_id')); 
       

        if (empty($famille)) {
            return new JsonResponse(['message' => 'Famille de medicament inexistante'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Famille_medicamentType::class, $famille);

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
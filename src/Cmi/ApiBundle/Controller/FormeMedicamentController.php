<?php
#src/Cmi\ApiBundle\/Controller/FormeMedicamentController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\Forme_medicamentType;
use Cmi\ApiBundle\Entity\Forme_medicament;

class FormeMedicamentController extends FOSRestController
{
	/*
	*@Rest\View(serializerGroups={"form_medic"})
	*@Rest\Get("/forme_medicaments/afficher")
	*/
	public function afficherForme_medicamentAction(Request $request)
	{
		$forme_medicaments = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Forme_medicament')
			->findAll();

			/* @var $forme_medicaments Forme_medicament[] */

			$formatted = [];
			foreach ($forme_medicaments as $forme_medicament) {
				# code...
				$formatted[] = [
					'form_medic_id' => $forme_medicament->getFormMedicId(),
					'form_medic_code' => $forme_medicament->getFormMedicCode(),
					'form_medic_libelle' => $forme_medicament->getFormMedicLibelle(),
					'form_medic_date_enreg' => $forme_medicament->getFormMedicDateEnreg(),
					'form_medic_date_modif' => $forme_medicament->getFormMedicDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/forme_medicaments/rechercher/{form_medic_id}")
	*/

	public function rechercherForme_medicamentAction(Request $request)
	{
		$forme_medicament = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Forme_medicament')
				->find($request->get('id'));

		/* @var $forme_medicament Forme_medicament */
		if (empty($forme_medicament)) {
			# code...
			return new JsonResponse(['message'=>'Forme de medicament inexistante'], Response::HTTP_NOT_FOUND);
		}

		$formatted[] = [
			'form_medic_id' => $forme_medicament->getFormMedicId(),
			'form_medic_code' => $forme_medicament->getFormMedicCode(),
			'form_medic_libelle' => $forme_medicament->getFormMedicLibelle(),
			'form_medic_date_enreg' => $forme_medicament->getFormMedicDateEnreg(),
			'form_medic_date_modif' => $forme_medicament->getFormMedicDateModif()
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/forme_medicaments/creer")
     */
	public function creerForme_medicamentAction(Request $request)
	{
		$forme = new Forme_medicament();

		$forme->setFormMedicDateEnreg(new \DateTime("now"));
		$forme->setFormMedicDateModif(new \DateTime("now"));

		$form = $this->createForm(Forme_medicamentType::class, $forme);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($forme);
			$em->flush();
			return $forme;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/forme_medicaments/supprimer/{form_medic_id}")
     */
    public function supprimerForme_medicamentAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $forme = $em->getRepository('Cmi\ApiBundle\:Forme_medicament')
                    ->find($request->get('form_medic_id'));
        /* @var $forme Forme_medicament */

       if($forme){
	       	$em->remove($forme);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/forme_medicaments/modifier/{form_medic_id}")
    */

    public function modifierForme_medicamentAction(Request $request)
    {
        return $this->modifierForme_medicament($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/forme_medicaments/modifier/{form_medic_id}")
     */
    public function patchForme_medicamentAction(Request $request)
    {
        return $this->modifierForme_medicament($request, false);
    }

    public function modifierForme_medicament(Request $request, $clearMissing)
    {
    	$forme = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Forme_medicament')
                ->find($request->get('form_medic_id')); 
       

        if (empty($forme)) {
            return new JsonResponse(['message' => 'Forme de medicament inexistante'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Forme_medicamentType::class, $forme);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($forme);
            $em->flush();
            return $forme;
        } else {
            return $form;
        }
	    
    }
}
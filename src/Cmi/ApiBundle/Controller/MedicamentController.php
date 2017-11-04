<?php
#src/Cmi\ApiBundle\/Controller/MedicamentController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\MedicamentType;
use Cmi\ApiBundle\Entity\Medicament;

class MedicamentController extends FOSRestController
{
	/*
	*@Rest\View()
	*@Rest\Get("/medicament/afficher")
	*/
	public function afficherMedicamentAction(Request $request)
	{
		$medicaments = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Medicament')
			->findAll();

			/* @var $pathos Pathologie[] */

			$formatted = [];
			foreach ($medicaments as $medicament) {
				# code...
				$formatted[] = [
					'medic_id' => $medicament->getMedicId(),
					'medic_code' => $medicament->getMedicCode(),
					'medic_libelle' => $medicament->getMedicLibelle(),
					'medic_famille_id' => $medicament->getMedicFamilleId(),
					'medic_forme_id' => $medicament->getMedicFormeId(),
					'medic_date_enreg' => $medicament->getMedicDateEnreg(),
					'medic_date_modif' => $medicament->getMedicDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/medicament/rechercher/{medic_id}")
	*/

	public function rechercherMedicamentAction(Request $request)
	{
		$medicament = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Medicament')
				->find($request->get('id'));

		/* @var $patho Pathologie */
		if (empty($medicament)) {
			# code...
			return new JsonResponse(['message'=>'Medicament inexistant'], Response::HTTP_NOT_FOUND);
		}

		$formatted[] = [
			'medic_id' => $medicament->getMedicId(),
			'medic_code' => $medicament->getMedicCode(),
			'medic_libelle' => $medicament->getMedicLibelle(),
			'medic_famille_id' => $medicament->getMedicFamilleId(),
			'medic_forme_id' => $medicament->getMedicFormeId(),
			'medic_date_enreg' => $medicament->getMedicDateEnreg(),
			'medic_date_modif' => $medicament->getMedicDateModif()
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/medicament/creer")
     */
	public function creerMedicamentAction(Request $request)
	{
		$medicament = new Medicament();

		$medicament->setMedicDateEnreg(new \DateTime("now"));
		$medicament->setMedicDateModif(new \DateTime("now"));

		$form = $this->createForm(MedicamentType::class, $medicament);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($medicament);
			$em->flush();
			return $medicament;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/medicament/supprimer/{medic_id}")
     */
    public function supprimerMedicamentAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $medicament = $em->getRepository('Cmi\ApiBundle\:Medicament')
                    ->find($request->get('medic_id'));
        /* @var $patho Pathologie */

       if($medicament){
	       	$em->remove($medicament);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/medicament/modifier/{medic_id}")
    */

    public function modifierMedicamentAction(Request $request)
    {
        return $this->modifierMedicament($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/medicament/modifier/{medic_id}")
     */
    public function patchMedicamentAction(Request $request)
    {
        return $this->modifierMedicament($request, false);
    }

    public function modifierMedicament(Request $request, $clearMissing)
    {
    	$medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Medicament')
                ->find($request->get('medic_id'));
       

        if (empty($medicament)) {
            return new JsonResponse(['message' => 'Medicament inexistant'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(MedicamentType::class, $patho);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($medicament);
            $em->flush();
            return $medicament;
        } else {
            return $form;
        }
	    
    }
}
<?php
#src/Cmi\ApiBundle\/Controller/PathologieController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\PathologieType;
use Cmi\ApiBundle\Entity\Pathologie;

class PathologieController extends FOSRestController
{
	/*
	*@Rest\View()
	*@Rest\Get("/pathologie/afficher")
	*/
	public function afficherPathologieAction(Request $request)
	{
		$pathos = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Pathologie')
			->findAll();

			/* @var $pathos Pathologie[] */

			$formatted = [];
			foreach ($pathos as $patho) {
				# code...
				$formatted[] = [
					'patho_id' => $patho->getPathoId(),
					'patho_code' => $patho->getPathoCode(),
					'patho_libelle' => $patho->getPathoLibelle(),
					'patho_famille_id' => $patho->getPathoFamilleId(),
					'patho_date_enreg' => $patho->getPathoDateEnreg(),
					'patho_date_modif' => $patho->getPathoDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/pathologie/rechercher/{patho_id}")
	*/

	public function rechercherPathologieAction(Request $request)
	{
		$patho = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Pathologie')
				->find($request->get('id'));

		/* @var $patho Pathologie */
		if (empty($patho)) {
			# code...
			return new JsonResponse(['message'=>'Pathologie inexistante'], Response::HTTP_NOT_FOUND);
		}

		$formatted = [
			'patho_id' => $patho->getPathoId(),
			'patho_code' => $patho->getPathoCode(),
			'patho_libelle' => $patho->getPathoLibelle(),
			'patho_famille_id' => $patho->getPathoFamilleId(),
			'patho_date_enreg' => $patho->getPathoDateEnreg(),
			'patho_date_modif' => $patho->getPathoDateModif(),
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/pathologie/creer")
     */
	public function creerPathologieAction(Request $request)
	{
		$patho = new Pathologie();

		$patho->setPathoDateEnreg(new \DateTime("now"));
		$patho->setPathoDateModif(new \DateTime("now"));

		$form = $this->createForm(PathologieType::class, $famille);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($patho);
			$em->flush();
			return $patho;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/pathologie/supprimer/{patho_id}")
     */
    public function supprimerPathologieAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $patho = $em->getRepository('Cmi\ApiBundle\:Pathologie')
                    ->find($request->get('patho_id'));
        /* @var $patho Pathologie */

       if($patho){
	       	$em->remove($patho);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/pathologie/modifier/{patho_id}")
    */

    public function modifierPathologieAction(Request $request)
    {
        return $this->modifierPathologie($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/pathologie/modifier/{patho_id}")
     */
    public function patchPathologieAction(Request $request)
    {
        return $this->modifierPathologie($request, false);
    }

    public function modifierPathologie(Request $request, $clearMissing)
    {
    	$patho = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Pathologie')
                ->find($request->get('patho_id'));
       

        if (empty($patho)) {
            return new JsonResponse(['message' => 'Pathologie inexistante'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PathologieType::class, $patho);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($patho);
            $em->flush();
            return $patho;
        } else {
            return $form;
        }
	    
    }
}
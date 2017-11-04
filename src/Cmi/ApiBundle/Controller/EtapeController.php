<?php
#src/Cmi\ApiBundle\/Controller/EtapeController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\EtapeType;
use Cmi\ApiBundle\Entity\Etape;

class EtapeController extends FOSRestController
{
	/*
	*@Rest\View()
	*@Rest\Get("/etapes/afficher")
	*/
	public function afficherEtapeAction(Request $request)
	{
		$etapes = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Etape')
			->findAll();

			/* @var $etapes Etape[] */

			$formatted = [];
			foreach ($etapes as $etape) {
				# code...
				$formatted[] = [
					'etp_id' => $etape->getEtpId(),
					'etp_code' => $etape->getEtpCode(),
					'etp_libelle' => $etape->getEtpLibelle(),
					'etp_date_enreg' => $etape->getEtpDateEnreg(),
					'etp_date_modif' => $etape->getEtpDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/etapes/rechercher/{etp_id}")
	*/

	public function rechercherEtapeAction(Request $request)
	{
		$etape = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Etape')
				->find($request->get('id'));

		/* @var $etape Etape */
		if (empty($etape)) {
			# code...
			return new JsonResponse(['message'=>'Etape inexistante'], Response::HTTP_NOT_FOUND);
		}

		$formatted = [
			'etp_id' => $etape->getEtpId(),
			'etp_code' => $etape->getEtpCode(),
			'etp_libelle' => $etape->getEtpLibelle(),
			'etp_date_enreg' => $etape->getEtpDateEnreg(),
			'etp_date_modif' => $etape->getEtpDateModif(),
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/etapes/creer")
     */
	public function creerEtapeAction(Request $request)
	{
		$etape = new Etape();

		$etape->setEtpDateEnreg(new \DateTime("now"));
		$etape->setEtpDateModif(new \DateTime("now"));

		$form = $this->createForm(EtapeType::class, $etape);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($etape);
			$em->flush();
			return $etape;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/etapes/supprimer/{etp_id}")
     */
    public function supprimerEtapeAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $etape = $em->getRepository('Cmi\ApiBundle\:Etape')
                    ->find($request->get('etp_id'));
        /* @var $etape Etape */

       if($etape){
	       	$em->remove($etape);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/etapes/modifier/{etp_id}")
    */

    public function modifierEtapeAction(Request $request)
    {
        return $this->modifierEtape($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/etapes/modifier/{etp_id}")
     */
    public function patchEtapeAction(Request $request)
    {
        return $this->modifierEtape($request, false);
    }

    public function modifierEtape(Request $request, $clearMissing)
    {
    	$etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Etape')
                ->find($request->get('etp_id')); // L'identifiant en tant que paramètre n'est plus nécessaire
       

        if (empty($etape)) {
            return new JsonResponse(['message' => 'Etape inexistante'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EtapeType::class, $etape);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($etape);
            $em->flush();
            return $etape;
        } else {
            return $form;
        }
	    
    }
}
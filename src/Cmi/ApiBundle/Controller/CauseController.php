<?php
#src/Cmi\ApiBundle\/Controller/CauseController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\CauseRepository;
use Cmi\ApiBundle\Entity\Cause;

class CauseController extends FOSRestController
{
	/*
	*@Rest\View()
	*@Rest\Get("/cause/afficher")
	*/
	public function afficherCauseAction(Request $request)
	{
		$causes = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Cause')
			->findAll();

			/* @var $causes Cause[] */

			$formatted = [];
			foreach ($causes as $cause) {
				# code...
				$formatted[] = [
					'cause_id' => $cause->getCauseId(),
					'cause_code' => $cause->getCauseCode(),
					'cause_libelle' => $cause->getCauseLibelle(),
					'cause_date_enreg' => $cause->getCauseDateEnreg(),
					'cause_date_modif' => $cause->getCauseDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/cause/rechercher/{cause_id}")
	*/

	public function rechercherCauseAction(Request $request)
	{
		$cause = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Cause')
				->find($request->get('id'));

		/* @var $cause Cause */
		if (empty($cause)) {
			# code...
			return new JsonResponse(['message'=>'Cause inexistante'], Response::HTTP_NOT_FOUND);
		}

		
		$formatted[] = [
			'cause_id' => $cause->getCauseId(),
			'cause_code' => $cause->getCauseCode(),
			'cause_libelle' => $cause->getCauseLibelle(),
			'cause_date_enreg' => $cause->getCauseDateEnreg(),
			'cause_date_modif' => $cause->getCauseDateModif()
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/cause/creer")
     */
	public function creerCauseAction(Request $request)
	{
		$cause = new Cause();

		$cause->setCauseDateEnreg(new \DateTime("now"));
		$cause->setCauseDateModif(new \DateTime("now"));

		$form = $this->createForm(CauseType::class, $cause);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($cause);
			$em->flush();
			return $cause;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/cause/supprimer/{cause_id}")
     */
    public function supprimerCauseAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $cause = $em->getRepository('Cmi\ApiBundle\:Cause')
                    ->find($request->get('cause_id'));
        /* @var $cause Cause */

       if($cause){
	       	$em->remove($cause);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/cause/modifier/{cause_id}")
    */

    public function modifierCauseAction(Request $request)
    {
        return $this->modifierCause($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/cause/modifier/{cause_id}")
     */
    public function patchCauseAction(Request $request)
    {
        return $this->modifierCause($request, false);
    }

    public function modifierCause(Request $request, $clearMissing)
    {
    	$cause = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Cause')
                ->find($request->get('cause_id')); 
       

        if (empty($cause)) {
            return new JsonResponse(['message' => 'Cause inexistante'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(CauseType::class, $cause);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($cause);
            $em->flush();
            return $cause;
        } else {
            return $form;
        }
	    
    }
}
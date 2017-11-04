<?php
#src/Cmi\ApiBundle\/Controller/DiagnostiqueController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Cmi\ApiBundle\Form\Type\DiagnostiqueRepository;
use Cmi\ApiBundle\Entity\Diagnostique;

class DiagnostiqueController extends FOSRestController
{
	/*
	*@Rest\View()
	*@Rest\Get("/diagnostiques/afficher")
	*/
	public function afficherDiagnostiqueAction(Request $request)
	{
		$diagnostiques = $this->get("doctrine.orm.entity_manager")
			->getRepository('Cmi\ApiBundle\:Diagnostique')
			->findAll();

			/* @var $diagnostiques Diagnostique[] */

			$formatted = [];
			foreach ($diagnostiques as $diagnostique) {
				# code...
				$formatted[] = [
					'diagn_id' => $diagnostique->getDiagnId(),
					'diagn_cause_id' => $diagnostique->getDiagnCauseId(),
					'diagn_consul_id' => $diagnostique->getDiagnConsulId(),
					'diagn_comment' => $diagnostique->getDiagnComment(),
					'diagn_date_enreg' => $diagnostique->getDiagnDateEnreg(),
					'diagn_date_modif' => $diagnostique->getDiagnDateModif()
				];
			}

		return new JsonResponse($formatted);
	}

	
	/*
	*@Rest\View()
	*@Rest\Get("/diagnostiques/rechercher/{diagn_id}")
	*/

	public function rechercherDiagnostiqueAction(Request $request)
	{
		$diagnostique = $this->get('doctrine.orm.entity_manager')
				->getRepository('Cmi\ApiBundle\:Diagnostique')
				->find($request->get('id'));

		/* @var $Diagnostique Diagnostique */
		if (empty($diagnostique)) {
			# code...
			return new JsonResponse(['message'=>'Diagnostique inexistant'], Response::HTTP_NOT_FOUND);
		}

		
		$formatted[] = [
			'diagn_id' => $diagnostique->getDiagnId(),
			'diagn_cause_id' => $diagnostique->getDiagnCauseId(),
			'diagn_consul_id' => $diagnostique->getDiagnConsulId(),
			'diagn_comment' => $diagnostique->getDiagnComment(),
			'diagn_date_enreg' => $diagnostique->getDiagnDateEnreg(),
			'diagn_date_modif' => $diagnostique->getDiagnDateModif()
		];

		return new JsonResponse($formatted);
		
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/diagnostiques/creer")
     */
	public function creerDiagnostiqueAction(Request $request)
	{
		$diagnostique = new Diagnostique();

		$diagnostique->setDiagnDateEnreg(new \DateTime("now"));
		$diagnostique->setDiagnDateModif(new \DateTime("now"));

		$form = $this->createForm(DiagnostiqueType::class, $diagnostique);

		$form ->submit($request->request->all()); // Validation des données

		if($form->isValid()) {

			$em = $this->get('doctrine.orm.entity_manager');
			$em->persist($diagnostique);
			$em->flush();
			return $diagnostique;	
		} else {

			return $form;
		}
	}


	/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/diagnostiques/supprimer/{diagn_id}")
     */
    public function supprimerDiagnostiqueAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $diagnostique = $em->getRepository('Cmi\ApiBundle\:Diagnostique')
                    ->find($request->get('diagn_id'));
        /* @var $Diagnostique Diagnostique */

       if($diagnostique){
	       	$em->remove($diagnostique);
	        $em->flush();
       }
    }


    /*
    * @Rest\View()
    * @Rest\Put("/diagnostiques/modifier/{diagn_id}")
    */

    public function modifierDiagnostiqueAction(Request $request)
    {
        return $this->modifierDiagnostique($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/diagnostiques/modifier/{diagn_id}")
     */
    public function patchDiagnostiqueAction(Request $request)
    {
        return $this->modifierDiagnostique($request, false);
    }

    public function modifierDiagnostique(Request $request, $clearMissing)
    {
    	$diagnostique = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Cmi\ApiBundle\:Diagnostique')
                ->find($request->get('diagn_id')); 
       

        if (empty($diagnostique)) {
            return new JsonResponse(['message' => 'Diagnostique inexistant'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DiagnostiqueType::class, $diagnostique);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($diagnostique);
            $em->flush();
            return $diagnostique;
        } else {
            return $form;
        }
	    
    }
}
<?php 
// src/Cmi/ApiBundle/Controller/SocieteController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\SocieteType;
use Cmi\ApiBundle\Entity\Societe;

class SocieteController extends FOSRestController
{

	/**
     * @Rest\View()
     * @Rest\Get("/societes/afficher")
     */
    public function getSocietesAction()
    {
    	$societes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Societe')
                ->findAll();
        /* @var $societes Societe[] */

         if (empty($societes)) {
            return new JsonResponse(['message' => 'Societes not found'], Response::HTTP_NOT_FOUND);
        }

        return $societes;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/societes/rechercher/{id}")
     */
    public function getSocieteAction( Request $request)
    {
    	$societe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Societe')
                ->find($request->get('id'));
        /* @var $societe Societe[] */

        if (empty($societe)) {
            return new JsonResponse(['message' => 'Societe not found'], Response::HTTP_NOT_FOUND);
        }

        return $societe;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/societes/creer")
     */
    public function postSocieteAction(Request $request)
    {

    	$societe = new Societe();


        $societe->setSocieteDateEnreg(new \DateTime("now"));
        $societe->setSocieteDateModif(new \DateTime("now"));

        $form = $this->createForm(SocieteType::class, $societe);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($societe);
            $em->flush();
            return $societe;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/societes/supprimer/{id}")
    */
    public function removeSocieteAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$societe = $em->getRepository('CmiApiBundle:Societe')
    				->find($request->get('id'));
    
    	 /* @var $societe Societe */

        if ($societe) {
    		$em->remove($societe);
    		$em->flush();
    	}
    }


    public function updateSociete(Request $request, $clearMissing)
    {

    	$societe = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Societe")
                        ->find($request->get('id'));

        
        $societe->setSocieteDateModif(new \DateTime("now"));

        if (empty($societe)) {
            # code...
            return new JsonResponse(['message'=>'Societe not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SocieteType::class, $societe);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($societe);
            $em->flush();
            return $societe;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/societes/modifier/{id}")
    */
    public function updateSocieteAction(Request $request)
    {
    	return $this->updateSociete($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/societes/modifier/{id}")
    */
    public function patchSocieteAction(Request $request)
    {
    	return $this->updateSociete($request, false);
    }
}
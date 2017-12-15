<?php 
// src/Cmi/ApiBundle/Controller/Famille_pathologieController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Famille_pathologieType;
use Cmi\ApiBundle\Entity\Famille_pathologie;

class Famille_pathologieController extends FOSRestController
{

	/**
     *@Rest\View(serializerGroups={"fam_pathologie"})
     * @Rest\Get("/familles_pathologies/afficher")
     */
    public function getFamillesPathologiesAction()
    {
    	$familles_pathologies = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_pathologie')
                ->findAll();
        /* @var $familles_pathologies Famille_pathologie[] */

         if (empty($familles_pathologies)) {
            return new JsonResponse(['message' => 'Familles de pathologies not found'], Response::HTTP_NOT_FOUND);
        }

        return $familles_pathologies;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/familles_pathologies/rechercher/{id}")
     */
    public function getFamillePathologieAction( Request $request)
    {
    	$famille_pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_pathologie')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($famille_pathologie)) {
            return new JsonResponse(['message' => 'Famille de pathologie not found'], Response::HTTP_NOT_FOUND);
        }

        return $famille_pathologie;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/familles_pathologies/creer")
     */
    public function postFamillePathologieAction(Request $request)
    {

    	$famille_pathologie = new Famille_pathologie();

        
        $famille_pathologie->setFamPathoDateEnreg(new \DateTime("now"));
        $famille_pathologie->setFamPathoDateModif(new \DateTime("now"));

        $form = $this->createForm(Famille_pathologieType::class, $famille_pathologie);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($famille_pathologie);
            $em->flush();
            return $famille_pathologie;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/familles_pathologies/supprimer/{id}")
    */
    public function removeFamillePathologieAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$famille_pathologie = $em->getRepository('CmiApiBundle:Famille_pathologie')
    				->find($request->get('id'));
    
    	 /* @var $famille_pathologie Famille_pathologie */

        if ($famille_pathologie) {
    		$em->remove($famille_pathologie);
    		$em->flush();
    	}
    }


    public function updateFamillePathologie(Request $request, $clearMissing)
    {

    	$famille_pathologie = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Famille_pathologie")
                        ->find($request->get('id'));

        
        $famille_pathologie->setFamPathoDateModif(new \DateTime("now"));

        if (empty($famille_pathologie)) {
            # code...
            return new JsonResponse(['message'=>'Famille de pathologie not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(FamillePathologieType::class, $famille_pathologie);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($famille_pathologie);
            $em->flush();
            return $famille_pathologie;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/familles_pathologies/modifier/{id}")
    */
    public function updateFamillePathologieAction(Request $request)
    {
    	return $this->updateFamillePathologie($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/familles_pathologies/modifier/{id}")
    */
    public function patchFamillePathologieAction(Request $request)
    {
    	return $this->updateFamillePathologie($request, false);
    }
}
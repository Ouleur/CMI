<?php 
// src/Cmi/ApiBundle/Controller/VisiteController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\VisiteType;
use Cmi\ApiBundle\Entity\Visite;

class VisiteController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"visite"})
     * @Rest\Get("/visites/afficher")
     */
    public function getVisitesAction()
    {
    	$visites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Visite')
                ->findAll();
        /* @var $visites Visite[] */

         if (empty($visites)) {
            return new JsonResponse(['message' => 'Visites not found'], Response::HTTP_NOT_FOUND);
        }

        return $visites;
    }

    /**
     * @Rest\View(serializerGroups={"visite"})
     * @Rest\Get("/pratitien/(prt_id)/visites/rechercher/")
     */
    public function getVisiteAction( Request $request)
    {
    	$visite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Visite')
                ->find($request->get('id'));
        /* @var $visite Visite[] */

        if (empty($visite)) {
            return new JsonResponse(['message' => 'Visite not found'], Response::HTTP_NOT_FOUND);
        }

        return $visite;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"visite"})
     * @Rest\Post("/medecin/{med_id}/etape/{etp_id}/visites/creer")
     */
    public function postVisiteAction(Request $request)
    {

        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medecin')
                ->find($request->get('f_id'));

        if (empty($medecin)) {
            return new JsonResponse(['message' => 'Medecin not found'], Response::HTTP_NOT_FOUND);
        }

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('fo_id'));

        if (empty($etape)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }

    	$visite = new Visite();

        $visite->setMedecin($medecin);
        $visite->setEtape($etape);

        $visite->setVstDateModif(new \DateTime("now")); 
        $visite->setVstDateEnreg(new \DateTime("now"));

        $form = $this->createForm(VisiteType::class, $visite);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($visite);
            $em->flush();
            return $visite;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT,serializerGroups={"visite"})
    * @Rest\Delete("/visites/supprimer/{id}")
    */
    public function removeVisiteAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$visite = $em->getRepository('CmiApiBundle:Visite')
    				->find($request->get('id'));
    
    	 /* @var $visite Visite */

        if ($visite) {
    		$em->remove($visite);
    		$em->flush();
    	}
    }


    public function updateMedVisite(Request $request, $clearMissing)
    {

        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medecin')
                ->find($request->get('f_id'));

        if (empty($medecin)) {
            return new JsonResponse(['message' => 'Medecin not found'], Response::HTTP_NOT_FOUND);
        }

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('fo_id'));

        if (empty($forme_visite)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }


    	$visite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Visite")
                        ->find($request->get('id'));

        $visite->setEtape($etape);
        $visite->setMedecin($medecin);

        $visite->setMedicDateModif(new \DateTime("now"));

        if (empty($visite)) {
            # code...
            return new JsonResponse(['message'=>'Visite not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(VisiteType::class, $visite);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($visite);
            $em->flush();
            return $visite;
        }else{
            return $form;
        }
    }


    public function updateInfVisite(Request $request, $clearMissing)
    {

        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medecin')
                ->find($request->get('f_id'));

        if (empty($medecin)) {
            return new JsonResponse(['message' => 'Medecin not found'], Response::HTTP_NOT_FOUND);
        }

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('fo_id'));

        if (empty($forme_visite)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }


        $visite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Visite")
                        ->find($request->get('id'));

        $visite->setEtape($etape);
        $visite->setMedecin($medecin);

        $visite->setMedicDateModif(new \DateTime("now"));

        if (empty($visite)) {
            # code...
            return new JsonResponse(['message'=>'Visite not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(VisiteType::class, $visite);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($visite);
            $em->flush();
            return $visite;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/medcin/{med_id}/etape/{etp_id}/visites/modifier/{id}")
    */
    public function updateVisiteMedAction(Request $request)
    {
    	return $this->updateVisite($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/medcin/{med_id}/etape/{etp_id}/{fo_id}/visites/modifier/{id}")
    */
    public function patchVisiteMedAction(Request $request)
    {
    	return $this->updateVisite($request, false);
    }


    /**
    * @Rest\View()
    * @Rest\Put("/medcin/{inf_id}/etape/{etp_id}/{fo_id}/visites/modifier/{id}")
    */
    public function updateVisiteInfAction(Request $request)
    {
        return $this->updateVisite($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/medcin/{inf_id}/etape/{etp_id}/{fo_id}/visites/modifier/{id}")
    */
    public function patchVisiteInfAction(Request $request)
    {
        return $this->updateVisite($request, false);
    }
}
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
     * @Rest\Get("/visites/afficher/{motif}")
     */
    public function getVisitesAction(Request $request)
    {
    	$visites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Visite')
        ->createQueryBuilder('p')
    ->where("p.vstMotif=:motif")
    ->setParameters(array("motif"=>$request->get('motif')))
        // ->setParameters(array("mtr"=>$request->get('phrase')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();
        /* @var $visites Visite[] */

         if (empty($visites)) {
            return new JsonResponse(['message' => 'Visites not found'], Response::HTTP_NOT_FOUND);
        }

        return $visites;
    }

    /**
     * @Rest\View(serializerGroups={"visite"})
     * @Rest\Get("/visites/afficher/{motif}/{et_id}")
     */
    public function getVisitesEtapeAction(Request $request)
    {
        $visites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Visite')
        ->createQueryBuilder('p')
    ->where("p.vstMotif=:motif and p.etape=:etape")
    ->setParameters(array("motif"=>$request->get('motif'),"etape"=>$request->get('et_id')))
        // ->setParameters(array("mtr"=>$request->get('phrase')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();
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
     * @Rest\Post("/patient/{pat_id}/infirm/{inf_id}/medecin/{med_id}/etape/{etp_id}/visites/creer")
     */
    public function postVisiteAction(Request $request)
    {

         $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('pat_id'));

        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('med_id'));

        if (empty($medecin)) {
            return new JsonResponse(['message' => 'Medecin not found'], Response::HTTP_NOT_FOUND);
        }

        $infirmier = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('inf_id'));

        if (empty($infirmier)) {
            return new JsonResponse(['message' => 'Infirmier not found'], Response::HTTP_NOT_FOUND);
        }

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('etp_id'));

        if (empty($etape)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }

    	$visite = new Visite();

        $visite->setMedecin($medecin);
        $visite->setInfirmier($infirmier);
        $visite->setEtape($etape);
        $visite->setPatient($patient);

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

         $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('pat_id'));

        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('med_id'));

        if (empty($medecin)) {
            return new JsonResponse(['message' => 'Medecin not found'], Response::HTTP_NOT_FOUND);
        }

        $infirmier = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('inf_id'));

        if (empty($infirmier)) {
            return new JsonResponse(['message' => 'Infirmier not found'], Response::HTTP_NOT_FOUND);
        }

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('etp_id'));

        if (empty($etape)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }

    	$visite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Visite")
                        ->find($request->get('v_id'));

        $visite->setEtape($etape);
        $visite->setMedecin($medecin);
        $visite->setInfirmier($infirmier);

        $visite->setVstDateModif(new \DateTime("now"));

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

         $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('pat_id'));

        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('med_id'));

        if (empty($medecin)) {
            return new JsonResponse(['message' => 'Medecin not found'], Response::HTTP_NOT_FOUND);
        }

        $infirmier = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('inf_id'));

        if (empty($infirmier)) {
            return new JsonResponse(['message' => 'Infirmier not found'], Response::HTTP_NOT_FOUND);
        }

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('etp_id'));

        if (empty($etape)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }



        $visite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Visite")
                        ->find($request->get('v_id'));

        $visite->setEtape($etape);
        $visite->setMedecin($medecin);
        $visite->setInfirmier($infirmier);

        $visite->setVstDateModif(new \DateTime("now"));

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
    * @Rest\Put("/patient/{pat_id}/infirm/{inf_id}/medecin/{med_id}/etape/{etp_id}/visites/{v_id}/Med/modifier")
    */
    public function updateVisiteMedAction(Request $request)
    {
    	return $this->updateMedVisite($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/patient/{pat_id}/infirm/{inf_id}/medecin/{med_id}/etape/{etp_id}/visites/{v_id}/MedPart/modifier")
    */
    public function patchVisiteMedAction(Request $request)
    {
    	return $this->updateMedVisite($request, false);
    }


    /**
    * @Rest\View()
    * @Rest\Put("/patient/{pat_id}/infirm/{inf_id}/medecin/{med_id}/etape/{etp_id}/visites/{v_id}/Inf/modifier")
    */
    public function updateVisiteInfAction(Request $request)
    {
        return $this->updateInfVisite($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/patient/{pat_id}/infirm/{inf_id}/medecin/{med_id}/etape/{etp_id}/visites/{v_id}/InfPart/modifier")
    */
    public function patchVisiteInfAction(Request $request)
    {
        return $this->updateInfVisite($request, false);
    }
}
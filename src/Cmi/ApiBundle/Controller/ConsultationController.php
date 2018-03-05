<?php 
// src/Cmi/ApiBundle/Controller/ConsultationController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ConsultationType;
use Cmi\ApiBundle\Entity\Consultation;
use Symfony\Component\Validator\Constraints\Date;

class ConsultationController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"consultation"})
     * @Rest\Get("/consultations/afficher")
     */
    public function getConsultationsAction()
    {
    	$consultations = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->findAll();


        /* @var $consultations Consultation[] */

         if (empty($consultations)) {
            return new JsonResponse(['message' => 'Consultations not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultations;
    }

    /**
     * @Rest\View(serializerGroups={"consultation"})

     * @Rest\Get("/consultations/rechercher/{id}")
     */
    public function getConsultationAction( Request $request)
    {
    	$consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('id'));
        /* @var $consultation Consultation[] */

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation;
    }

    /**
     * @Rest\View(serializerGroups={"consultation"})
     * @Rest\Get("/consultationsJour")
     */
    public function getConsultationJourAction( Request $request)
    {
        $consultation = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Consultation')
        ->createQueryBuilder('c')
        ->where("c.cons_date=:date")
        ->setParameters(array("date"=>Date('Y-m-d')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();

        /* @var $consultation Consultation[] */

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'.Date('Y-m-d')], Response::HTTP_NOT_FOUND);
        }

        return $consultation;
    }

    /**
     * @Rest\View(serializerGroups={"consultation"})
     * @Rest\Get("/consultations/etape/{n_id}/rechercher")
     */
    public function getConsultationEtapeAction( Request $request)
    {

        $condition  ="";
        if ($request->get('n_id')==4 || $request->get('n_id')==3) {
            # code...
            $condition = "c.etape=:niveau_id or c.etape=5";
        }else {
            # code...
            $condition = "c.etape=:niveau_id";

        }

        $consultation = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Consultation')
        ->createQueryBuilder('c')
        ->where($condition)
        ->setParameters(array("niveau_id"=>$request->get('n_id')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();

        /* @var $consultation Consultation[] */

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"consultation"})
     * @Rest\Post("/patient/{p_id}/infirmier/{inf_id}/mofitifs/{mot_id}/specialite/{spe_id}/medecin/{med_id}/etape/{etp_id}/consultations/creer")
     */
    public function postConsultationAction(Request $request)
    {

        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('p_id'));

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('etp_id'));


        $consultation = new Consultation(); 

        //infirmier
        $infirmier = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('inf_id'));

        $mot_id = explode(",",$request->get('mot_id'));
        for ($i=0; $i < count($mot_id); $i++) { 
            # code...
            //motifs
            $motif = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('CmiApiBundle:Motif')
                    ->find($mot_id[$i]);
            $consultation->addMotif($motif);
        }
        
        //speci
        $specialite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Specialite')
                ->find($request->get('spe_id'));
        //medecin
        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('med_id'));
	

        $consultation->setPatient($patient);
        $consultation->setEtape($etape);
        $consultation->setInfirmier($infirmier);
        $consultation->setSpecialite($specialite);
        $consultation->setMedecin($medecin);

        $consultation->setConsDate(new \DateTime("now"));
        $consultation->setConsDateEnreg(new \DateTime("now"));
        $consultation->setConsDateModif(new \DateTime("now"));

        $form = $this->createForm(ConsultationType::class, $consultation);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($consultation);
            $em->flush();
            return $consultation;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT,serializerGroups={"consultation"})
    * @Rest\Delete("/consultations/supprimer/{id}")
    */
    public function removeConsultationAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$consultation = $em->getRepository('CmiApiBundle:Consultation')
    				->find($request->get('id'));
    
    	 /* @var $consultation Consultation */

        if ($consultation) {
    		$em->remove($consultation);
    		$em->flush();
    	}
    }





    public function updateConsultation(Request $request, $clearMissing)
    {

        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('p_id'));

        $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('etp_id'));

        //infirmier
        $infirmier = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('inf_id'));

        // $mot_id = explode(",",$request->get('mot_id'));
        // for ($i=0; $i < count($mot_id); $i++) { 
        //     # code...
        //     //motifs
        //     $motif = $this->get('doctrine.orm.entity_manager')
        //             ->getRepository('CmiApiBundle:Motif')
        //             ->find($mot_id[$i]);
        //     $consultation->addMotif($motif);

        // }
        
        //speci
        $specialite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Specialite')
                ->find($request->get('spe_id'));
        //medecin
        $medecin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('med_id'));


        
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        $consultation->setPatient($patient);
        if ($consultation->getEtape()->getId()==4 && $etape->getId()<4) {
            # code...
            $etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find(5);
        }
        $consultation->setEtape($etape);
        $consultation->setInfirmier($infirmier);
        $consultation->setSpecialite($specialite);
        $consultation->setMedecin($medecin);
    	
        $consultation->setConsDateModif(new \DateTime("now"));

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ConsultationType::class, $consultation);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($consultation);
            $em->flush();
            return $consultation;
        }else{
            return $form;
        }
    }


    /**
     * @Rest\View(serializerGroups={"consultation"})
    * @Rest\Put("/patient/{p_id}/infirmier/{inf_id}/mofitifs/{mot_id}/specialite/{spe_id}/medecin/{med_id}/etape/{etp_id}/consultations/modifier/{id}")
    */
    public function updateConsultationAction(Request $request)
    {
    	return $this->updateConsultation($request, false);
    }

    /**
     * @Rest\View(serializerGroups={"consultation"})
    * @Rest\Patch("/patient/{p_id}/infirmier/{inf_id}/specialite/{spe_id}/medecin/{med_id}/etape/{etp_id}/consultations/modifier/{id}")
    */
    public function patchConsultationAction(Request $request)
    {
    	return $this->updateConsultation($request, false);
    }


    /**
    *Save Motif off medecin
    * @Rest\View(serializerGroups={"consultation"})
    * @Rest\Patch("/motifs/{mot_id}/consultations/modifier/{id}")
    */
    public function patchConsultationMotifsAction(Request $request)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        $mot_id = explode(",",$request->get('mot_id'));
        for ($i=0; $i < count($mot_id); $i++) { 
            # code...
            //motifs
            $motif = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('CmiApiBundle:Motif')
                    ->find($mot_id[$i]);
            $consultation->addMotif($motif);

        }

        $em = $this->get('doctrine.orm.entity_manager');
        $em->merge($consultation);
        $em->flush();

        return $consultation;
    }


    /**
     * @Rest\View(serializerGroups={"consultation"})
    * @Rest\Patch("/consultations/modifier/{id}")
    */
    public function patchConsultationPartielAction(Request $request)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }


        $form = $this->createForm(ConsultationType::class, $consultation);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($consultation);
            $em->flush();
            return $consultation;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View(serializerGroups={"consultation"})
    * @Rest\Patch("/etape/{etp_id}/consultations/modifier/{id}")
    */
    public function patchConsultationModifierEtapeAction(Request $request)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        $etape = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Etape")
                        ->find($request->get('etp_id'));

        $consultation->setEtape($etape);

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }


        // $form = $this->createForm(ConsultationType::class, $consultation);


        // $form->submit($request->query->all(),$clearMissing); // Validation des données

        // if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($consultation);
            $em->flush();
            return $consultation;
        // }else{
        //     return $form;
        // }
    }
}
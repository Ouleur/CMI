<?php 
// src/Cmi/ApiBundle/Controller/PatientRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PatientType;
use Cmi\ApiBundle\Entity\Consultation;

class PatientRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/consultation/{id}/patient")
     */
    public function getPatientRelationAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("id"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation->getPatient();
    }



    public function updateConsultationPatient(Request $request, $clearMissing)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        
        $consultation->setConsDateModif(new \DateTime("now"));

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }


        $patient = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Patient")
                        ->find($request->get('pat_id'));

                
        $consultation->setPatient($patient);

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
    * @Rest\View()
    * @Rest\Put("/consultation/{id}/patient/{pat_id}")
    */
    public function updateConsultationPatientAction(Request $request)
    {
        return $this->updateConsultationPatient($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{id}/patient/{pat_id}")
    */
    public function patchConsultationPatientAction(Request $request)
    {
        return $this->updateConsultationPatient($request, false);
    }
}
<?php 
// src/Cmi/ApiBundle/Controller/Type_patientRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PatientType;
use Cmi\ApiBundle\Entity\Type_patient;

class Type_patientRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/patient/{id}/type_patient")
     */
    public function getPatientTypeAction(Request $request)
    {

        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get("id"));

        if (empty($patient)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patient->getCartes();
    }



    public function updatePatient(Request $request, $clearMissing)
    {
        $patient = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Patient")
                        ->find($request->get('id'));

        
        $patient->setPatDateModif(new \DateTime("now"));

        if (empty($patient)) {
            # code...
            return new JsonResponse(['message'=>'Patient not found'],Response::HTTP_NOT_FOUND);
        }


        $type_patient = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_patient")
                        ->find($request->get('tp_id'));

                
        $patient->setTypePatient($type_patient);

        $form = $this->createForm(PatientType::class, $patient);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($patient);
            $em->flush();
            return $patient;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/patient/{id}/type_patient/{tp_id}")
    */
    public function updatePatientProffessionAction(Request $request)
    {
        return $this->updatePatient($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/patient/{id}/type_patient/{tp_id}")
    */
    public function patchPatientProffessionAction(Request $request)
    {
        return $this->updatePatient($request, false);
    }
}
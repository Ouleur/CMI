<?php 
// src/Cmi/ApiBundle/Controller/ProffessionRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PatientType;
use Cmi\ApiBundle\Entity\Proffession;

class ProffessionRelationController extends FOSRestController
{


	// Pour recuperer la proffesion d'un Agent
    /**
     * @Rest\View()
     * @Rest\Get("/patient/{id}/proffession")
     */
    public function getPatientProffessionAction(Request $request)
    {

        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get("id"));

        if (empty($patient)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patient->getProffession();
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


        $proffession = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Proffession")
                        ->find($request->get('p_id'));

                
        $patient->setProffession($proffession);

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
    * @Rest\Put("/patient/{id}/proffession/{p_id}")
    */
    public function updatePatientAction(Request $request)
    {
        return $this->updatePatient($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/patient/{id}/proffession/{p_id}")
    */
    public function patchPatientAction(Request $request)
    {
        return $this->updatePatient($request, false);
    }
}
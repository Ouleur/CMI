<?php 
// src/Cmi/ApiBundle/Controller/PatientControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PatientType;
use Cmi\ApiBundle\Entity\Patient;

class PatientController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/patients")
     */
    public function getPatientsAction()
    {

    	$patients = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->findAll();
        /* @var $places Place[] */

         if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/patients/{id}")
     */
    public function getPatientAction( Request $request)
    {

    	$patients = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/patients")
     */
    public function postPatientsAction(Request $request)
    {

    	$patient = new Patient();

        // $patient->setPatientNumero($request->get("numero"));
        // $patient->setPatientCode($request->get("code"));
        $patient->setPatDateEnreg(new \DateTime("now"));
        $patient->setPatDateModif(new \DateTime("now"));

        $form = $this->createForm(PatientType::class, $patient);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($patient);
            $em->flush();
            return $patient;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/patients/{id}")
    */
    public function removePatientsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$patient = $em->getRepository('CmiApiBundle:Patient')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($patient) {
    		$em->remove($patient);
    		$em->flush();
    	}

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
    * @Rest\Put("/patients/{id}")
    */
    public function updatePatientAction(Request $request)
    {
        return $this->updatePatient($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/patients/{id}")
    */
    public function patchPatientAction(Request $request)
    {
        return $this->updatePatient($request, false);
    }

}
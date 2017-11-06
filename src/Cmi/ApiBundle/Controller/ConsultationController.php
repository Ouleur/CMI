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

class ConsultationController extends FOSRestController
{

	/**
     * @Rest\View()
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
     * @Rest\View()
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
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/consultations/creer")
     */
    public function postConsultationAction(Request $request)
    {

    	$consultation = new Consultation();


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
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
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

    	$consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        
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
    * @Rest\View()
    * @Rest\Put("/consultations/modifier/{id}")
    */
    public function updateConsultationAction(Request $request)
    {
    	return $this->updateConsultation($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/consultations/modifier/{id}")
    */
    public function patchConsultationAction(Request $request)
    {
    	return $this->updateConsultation($request, false);
    }
}
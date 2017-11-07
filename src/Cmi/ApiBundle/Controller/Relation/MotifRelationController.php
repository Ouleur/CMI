<?php 
// src/Cmi/ApiBundle/Controller/MotifRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ConsultationType;
use Cmi\ApiBundle\Entity\Motif;

class MotifRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/consultation/{id}/motif")
     */
    public function getMotifRelationAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("id"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation->getMotifs();
    }



    public function updateConsultationMotif(Request $request, $clearMissing)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        
        $consultation->setConsDateModif(new \DateTime("now"));

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }


        $motif = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Motif")
                        ->find($request->get('mt_id'));

                
        $consultation->addMotif($motif);

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
    * @Rest\Put("/consultation/{id}/motif/{mt_id}")
    */
    public function updateConsultationMotifAction(Request $request)
    {
        return $this->updateConsultationMotif($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{id}/motif/{mt_id}")
    */
    public function patchConsultationMotifAction(Request $request)
    {
        return $this->updateConsultationMotif($request, false);
    }
}
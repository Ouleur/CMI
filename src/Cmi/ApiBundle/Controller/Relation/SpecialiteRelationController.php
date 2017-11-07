<?php 
// src/Cmi/ApiBundle/Controller/SpecialiteRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ConsultationType;
use Cmi\ApiBundle\Entity\Specialite;

class SpecialiteRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/consultation/{id}/specialite")
     */
    public function getSpecialiteRelationAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("id"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation->getSpecialite();
    }



    public function updateConsultationSpecialite(Request $request, $clearMissing)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        
        $consultation->setConsDateEnreg(new \DateTime("now"));

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }


        $specialite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Specialite")
                        ->find($request->get('sp_id'));

                
        $consultation->setSpecialite($specialite);

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
    * @Rest\Put("/consultation/{id}/specialite/{sp_id}")
    */
    public function updateConsultationSpecialiteAction(Request $request)
    {
        return $this->updateConsultationSpecialite($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{id}/specialite/{sp_id}")
    */
    public function patchConsultationSpecialiteAction(Request $request)
    {
        return $this->updateConsultationSpecialite($request, false);
    }
}
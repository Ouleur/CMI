<?php 
// src/Cmi/ApiBundle/Controller/EtapeRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ConsultationType;
use Cmi\ApiBundle\Entity\Etape;

class EtapeRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/consultation/{id}/etape")
     */
    public function getEtapeRelationAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("id"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation->getEtape();
    }



    public function updateConsultationEtape(Request $request, $clearMissing)
    {
        $consultation = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Consultation")
                        ->find($request->get('id'));

        
        $consultation->setConsDateEnreg(new \DateTime("now"));

        if (empty($consultation)) {
            # code...
            return new JsonResponse(['message'=>'Consultation not found'],Response::HTTP_NOT_FOUND);
        }


        $etape = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Etape")
                        ->find($request->get('et_id'));

                
        $consultation->setEtape($etape);

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
    * @Rest\Put("/consultation/{id}/etape/{et_id}")
    */
    public function updateConsultationEtapeAction(Request $request)
    {
        return $this->updateConsultationEtape($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{id}/etape/{et_id}")
    */
    public function patchConsultationEtapeAction(Request $request)
    {
        return $this->updateConsultationEtape($request, false);
    }
}
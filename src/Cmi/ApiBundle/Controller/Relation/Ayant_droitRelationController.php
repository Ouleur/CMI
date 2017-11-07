<?php 
// src/Cmi/ApiBundle/Controller/Ayant_droitRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentType;
use Cmi\ApiBundle\Entity\Categorie;

class Ayant_droitRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/agent/{id}/ayant_droit")
     */
    public function getAyantDroitRelationAction(Request $request)
    {

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->find($request->get("id"));

        if (empty($agent)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent->getAyantDroits();
    }



    public function updateAgentAyantDroit(Request $request, $clearMissing)
    {
        $agent = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Agent")
                        ->find($request->get('id'));

        
        $agent->setAgentDateModif(new \DateTime("now"));

        if (empty($agent)) {
            # code...
            return new JsonResponse(['message'=>'Agent not found'],Response::HTTP_NOT_FOUND);
        }


        $ayantDroit = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Ayant_droit")
                        ->find($request->get('ad_id'));

                
        $agent->addAyantDroit($ayantDroit);

        $form = $this->createForm(AgentType::class, $agent);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($agent);
            $em->flush();
            return $agent;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/agent/{id}/ayant_droit/{ad_id}")
    */
    public function updateAgentAyantDroitAction(Request $request)
    {
        return $this->updateAgentAyantDroit($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/agent/{id}/ayant_droit/{ad_id}")
    */
    public function patchAgentAyantDroitAction(Request $request)
    {
        return $this->updateAgentAyantDroit($request, false);
    }
}
<?php 
// src/Cmi/ApiBundle/Controller/Lieu_travailRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentType;
use Cmi\ApiBundle\Entity\Lieu_travail;

class Lieu_travailRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/agent/{id}/lieu_travail")
     */
    public function getLieuTravailRelationAction(Request $request)
    {

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->find($request->get("id"));

        if (empty($agent)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent->getLieuTravail();
    }



    public function updateAgent(Request $request, $clearMissing)
    {
        $agent = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Agent")
                        ->find($request->get('id'));

        
        $agent->setAgentDateModif(new \DateTime("now"));

        if (empty($agent)) {
            # code...
            return new JsonResponse(['message'=>'Agent not found'],Response::HTTP_NOT_FOUND);
        }


        $lieu_travail = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Lieu_travail")
                        ->find($request->get('lt_id'));

                
        $agent->setTypePatient($lieu_travail);

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
    * @Rest\Put("/agent/{id}/lieu_travail/{lt_id}")
    */
    public function updatePatientProffessionAction(Request $request)
    {
        return $this->updatePatient($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/agent/{id}/lieu_travail/{lt_id}")
    */
    public function patchPatientProffessionAction(Request $request)
    {
        return $this->updatePatient($request, false);
    }
}
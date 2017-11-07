<?php 
// src/Cmi/ApiBundle/Controller/Type_contratRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentType;
use Cmi\ApiBundle\Entity\Type_contrat;

class Type_contratRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/agent/{id}/type_contrat")
     */
    public function getTypeContratRelationAction(Request $request)
    {

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->find($request->get("id"));

        if (empty($agent)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent->getTypeContrat();
    }



    public function UpdateAgentTypeContrat(Request $request, $clearMissing)
    {
        $agent = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Agent")
                        ->find($request->get('id'));

        
        $agent->setAgentDateModif(new \DateTime("now"));

        if (empty($agent)) {
            # code...
            return new JsonResponse(['message'=>'Agent not found'],Response::HTTP_NOT_FOUND);
        }


        $type_contrat = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_contrat")
                        ->find($request->get('tc_id'));

                
        $agent->setTypeContrat($type_contrat);

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
    * @Rest\Put("/agent/{id}/type_contrat/{tc_id}")
    */
    public function UpdateAgentTypeContratTypeContratAction(Request $request)
    {
        return $this->UpdateAgentTypeContrat($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/agent/{id}/type_contrat/{tc_id}")
    */
    public function patchAgentTypeContratAction(Request $request)
    {
        return $this->UpdateAgentTypeContrat($request, false);
    }
}
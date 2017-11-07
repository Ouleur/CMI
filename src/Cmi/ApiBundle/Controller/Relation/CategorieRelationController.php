<?php 
// src/Cmi/ApiBundle/Controller/CategorieRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentType;
use Cmi\ApiBundle\Entity\Categorie;

class CategorieRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/agent/{id}/categorie")
     */
    public function getCategorieRelationAction(Request $request)
    {

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->find($request->get("id"));

        if (empty($agent)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent->getCategorie();
    }



    public function updateAgentCategorie(Request $request, $clearMissing)
    {
        $agent = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Agent")
                        ->find($request->get('id'));

        
        $agent->setAgentDateModif(new \DateTime("now"));

        if (empty($agent)) {
            # code...
            return new JsonResponse(['message'=>'Agent not found'],Response::HTTP_NOT_FOUND);
        }


        $categorie = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Categorie")
                        ->find($request->get('cat_id'));

                
        $agent->setCategorie($categorie);

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
    * @Rest\Put("/agent/{id}/categorie/{cat_id}")
    */
    public function updateAgentCategorieAction(Request $request)
    {
        return $this->updateAgentCategorie($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/agent/{id}/categorie/{cat_id}")
    */
    public function patchAgentCategorieAction(Request $request)
    {
        return $this->updateAgentCategorie($request, false);
    }
}
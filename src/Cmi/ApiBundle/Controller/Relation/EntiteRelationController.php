<?php 
// src/Cmi/ApiBundle/Controller/entiteRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentType;
use Cmi\ApiBundle\Entity\Categorie;

class EntiteRelationController extends FOSRestController
{
	// Pour recuperer les an des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/agent/{id}/entite")
     */
    public function getEntiteRelationAction(Request $request)
    {

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->find($request->get("id"));

        if (empty($agent)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent->getCategorie();
    }



    public function updateAgentEntite(Request $request, $clearMissing)
    {
        $agent = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Agent")
                        ->find($request->get('id'));

        
        $agent->setAgentDateModif(new \DateTime("now"));

        if (empty($agent)) {
            # code...
            return new JsonResponse(['message'=>'Agent not found'],Response::HTTP_NOT_FOUND);
        }


        $entite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Entite")
                        ->find($request->get('ent_id'));

                
        $agent->setEntite($entite);

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
    * @Rest\Put("/agent/{id}/entite/{ent_id}")
    */
    public function updateAgentEntiteAction(Request $request)
    {
        return $this->updateAgentEntite($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/agent/{id}/entite/{ent_id}")
    */
    public function patchAgentEntiteAction(Request $request)
    {
        return $this->updateAgentEntite($request, false);
    }





    // Pour recuperer les cartes des societe
    /**
     * @Rest\View()
     * @Rest\Get("/entite/{id}/societe")
     */
    public function getSocieteRelationAction(Request $request)
    {

        $entite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get("id"));

        if (empty($entite)) {
            return new JsonResponse(['message' => 'Entite not found'], Response::HTTP_NOT_FOUND);
        }

        return $entite->getSociete();
    }



    public function updateEntiteSociete(Request $request, $clearMissing)
    {
        $entite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Entite")
                        ->find($request->get('id'));

        
        $entite->setEntiDateModif(new \DateTime("now"));

        if (empty($entite)) {
            # code...
            return new JsonResponse(['message'=>'Enfant not found'],Response::HTTP_NOT_FOUND);
        }


        $societe = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Societe")
                        ->find($request->get('st_id'));

                
        $societe->setEntite($entite);

        $form = $this->createForm(AgentType::class, $entite);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($entite);
            $em->flush();
            return $entite;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/entite/{id}/societe/{st_id}")
    */
    public function updateEntieSocieteAction(Request $request)
    {
        return $this->updateEntiteSociete($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/entite/{id}/societe/{st_id}")
    */
    public function patchEntieSocieteAction(Request $request)
    {
        return $this->updateEntiteSociete($request, false);
    }




        // Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/enfant/{id}/parent")
     */
    public function getParentalRelationAction(Request $request)
    {

        $enfant = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get("id"));

        if (empty($enfant)) {
            return new JsonResponse(['message' => 'Enfant not found'], Response::HTTP_NOT_FOUND);
        }

        return $enfant->getParent();
    }



    public function updateEnfantParent(Request $request, $clearMissing)
    {
        $enfant = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Entite")
                        ->find($request->get('id'));

        
        $enfant->setEntiDateModif(new \DateTime("now"));

        if (empty($enfant)) {
            # code...
            return new JsonResponse(['message'=>'Enfant not found'],Response::HTTP_NOT_FOUND);
        }


        $parent = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Entite")
                        ->find($request->get('ent_id'));

                
        $enfant->setParent($parent);

        $form = $this->createForm(AgentType::class, $enfant);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($enfant);
            $em->flush();
            return $enfant;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/enfant/{id}/parent/{ent_id}")
    */
    public function updateEnfantParentAction(Request $request)
    {
        return $this->updateAgentEntite($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/enfant/{id}/parent/{ent_id}")
    */
    public function patchEnfantParentAction(Request $request)
    {
        return $this->updateAgentEntite($request, false);
    }
}
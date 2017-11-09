<?php 
// src/Cmi/ApiBundle/Controller/AgentMaterielController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentMaterielType;
use Cmi\ApiBundle\Entity\AgentMateriel;

class AgentMaterielController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/agentmateriels/afficher")
     */
    public function getAgentMaterielsAction()
    {
        $agentmateriels = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AgentMateriel')
                ->findAll();
        /* @var $agentmateriels AgentMateriel[] */

         if (empty($agentmateriels)) {
            return new JsonResponse(['message' => 'AgentMateriels not found'], Response::HTTP_NOT_FOUND);
        }

        return $agentmateriels;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/agentmateriels/rechercher/{id}")
     */
    public function getAgentMaterielAction( Request $request)
    {
        $agentmateriel = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AgentMateriel')
                ->find($request->get('id'));
        /* @var $agentmateriel AgentMateriel[] */

        if (empty($agentmateriel)) {
            return new JsonResponse(['message' => 'AgentMateriel not found'], Response::HTTP_NOT_FOUND);
        }

        return $agentmateriel;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/agentmateriels/creer")
     */
    public function postAgentMaterielAction(Request $request)
    {

        $agentmateriel = new AgentMateriel();


        $agentmateriel->setAmDateEnreg(new \DateTime("now"));
        $agentmateriel->setAmDateModif(new \DateTime("now"));

        $form = $this->createForm(AgentMaterielType::class, $agentmateriel);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($agentmateriel);
            $em->flush();
            return $agentmateriel;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/agentmateriels/supprimer/{id}")
    */
    public function removeAgentMaterielAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $agentmateriel = $em->getRepository('CmiApiBundle:AgentMateriel')
                    ->find($request->get('id'));
    
         /* @var $agentmateriel AgentMateriel */

        if ($agentmateriel) {
            $em->remove($agentmateriel);
            $em->flush();
        }
    }


    public function updateAgentMateriel(Request $request, $clearMissing)
    {

        $agentmateriel = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:AgentMateriel")
                        ->find($request->get('id'));

        
        $agentmateriel->setAmDateModif(new \DateTime("now"));

        if (empty($agentmateriel)) {
            # code...
            return new JsonResponse(['message'=>'AgentMateriel not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AgentMaterielType::class, $agentmateriel);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($agentmateriel);
            $em->flush();
            return $agentmateriel;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/agentmateriels/modifier/{id}")
    */
    public function updateAgentMaterielAction(Request $request)
    {
        return $this->updateAgentMateriel($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/agentmateriels/modifier/{id}")
    */
    public function patchAgentMaterielAction(Request $request)
    {
        return $this->updateAgentMateriel($request, false);
    }
}
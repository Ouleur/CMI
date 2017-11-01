<?php 
// src/Cmi/ApiBundle/Controller/AgentControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AgentType;
use Cmi\ApiBundle\Entity\Agent;

class AgentController extends FOSRestController
{

	/**
     * @Rest\View()
     * @Rest\Get("/agent")
     */
    public function getAgentsAction()
    {
    	$agents = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->findAll();
        /* @var $agents Agent[] */

         if (empty($agents)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agents;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/agent/{id}")
     */
    public function getAgentAction( Request $request)
    {
    	$agents = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Agent')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($agents)) {
            return new JsonResponse(['message' => 'Agent not found'], Response::HTTP_NOT_FOUND);
        }

        return $agents;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/agent")
     */
    public function postAgentsAction(Request $request)
    {

    	$agent = new Agent();

        // $agent->setAgentNumero($request->get("numero"));
        // $agent->setAgentCode($request->get("code"));
        $agent->setAgentDateEnreg(new \DateTime("now"));
        $agent->setAgentDateModif(new \DateTime("now"));

        $form = $this->createForm(AgentType::class, $agent);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($agent);
            $em->flush();
            return $agent;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/agent/{id}")
    */
    public function removeAgentsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$agent = $em->getRepository('CmiApiBundle:Agent')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($agent) {
    		$em->remove($agent);
    		$em->flush();
    	}
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
    * @Rest\Put("/agent/{id}")
    */
    public function updateAgentAction(Request $request)
    {
    	return $this->updateAgent($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/agent/{id}")
    */
    public function patchAgentAction(Request $request)
    {
    	return $this->updateAgent($request, false);
    }
}
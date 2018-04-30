<?php 
// src/Cmi/ApiBundle/Controller/CauseController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CauseType;
use Cmi\ApiBundle\Entity\Cause;

class CauseController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"cause"})
     * @Rest\Get("/causes/afficher")
     */
    public function getCausesAction()
    {
    	$causes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Cause')
                ->findAll();
        /* @var $causes Cause[] */

         if (empty($causes)) {
            return new JsonResponse(['message' => 'Causes not found'], Response::HTTP_NOT_FOUND);
        }

        return $causes;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/causes/rechercher/{id}")
     */
    public function getCauseAction( Request $request)
    {
    	$cause = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Cause')
                ->find($request->get('id'));
        /* @var $cause Cause[] */

        if (empty($cause)) {
            return new JsonResponse(['message' => 'Cause not found'], Response::HTTP_NOT_FOUND);
        }

        return $cause;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/causes/creer")
     */
    public function postCauseAction(Request $request)
    {

    	$cause = new Cause();

        
        $cause->setCauseDateEnreg(new \DateTime("now"));
        $cause->setCauseDateModif(new \DateTime("now"));

        $form = $this->createForm(CauseType::class, $cause);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($cause);
            $em->flush();
            return $cause;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/causes/supprimer/{id}")
    */
    public function removeCauseAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$cause = $em->getRepository('CmiApiBundle:Cause')
    				->find($request->get('id'));
    
    	 /* @var $cause Cause */

        if ($cause) {
    		$em->remove($cause);
    		$em->flush();
    	}
    }


    public function updateCause(Request $request, $clearMissing)
    {

    	$cause = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Cause")
                        ->find($request->get('id'));

        
        $cause->setCauseDateModif(new \DateTime("now"));

        if (empty($cause)) {
            # code...
            return new JsonResponse(['message'=>'Cause not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(CauseType::class, $cause);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($cause);
            $em->flush();
            return $cause;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/causes/modifier/{id}")
    */
    public function updateCauseAction(Request $request)
    {
    	return $this->updateCause($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/causes/modifier/{id}")
    */
    public function patchCauseAction(Request $request)
    {
    	return $this->updateCause($request, false);
    }
}
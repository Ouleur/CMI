<?php 
// src/Cmi/ApiBundle/Controller/EtapeController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\EtapeType;
use Cmi\ApiBundle\Entity\Etape;

class EtapeController extends FOSRestController
{

	/**
     * @Rest\View()
     * @Rest\Get("/etapes/afficher")
     */
    public function getEtapesAction()
    {
    	$etapes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->findAll();
        /* @var $etapes Etape[] */

         if (empty($etapes)) {
            return new JsonResponse(['message' => 'Etapes not found'], Response::HTTP_NOT_FOUND);
        }

        return $etapes;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/etapes/rechercher/{id}")
     */
    public function getEtapeAction( Request $request)
    {
    	$etape = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Etape')
                ->find($request->get('id'));
        /* @var $etape Etape[] */

        if (empty($etape)) {
            return new JsonResponse(['message' => 'Etape not found'], Response::HTTP_NOT_FOUND);
        }

        return $etape;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/etapes/creer")
     */
    public function postEtapeAction(Request $request)
    {

    	$etape = new Etape();

        
        $etape->setEtpDateEnreg(new \DateTime("now")); 
        $etape->setEtpDateModif(new \DateTime("now"));

        $form = $this->createForm(EtapeType::class, $etape);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($etape);
            $em->flush();
            return $etape;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/etapes/supprimer/{id}")
    */
    public function removeEtapeAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$etape = $em->getRepository('CmiApiBundle:Etape')
    				->find($request->get('id'));
    
    	 /* @var $etape Etape */

        if ($etape) {
    		$em->remove($etape);
    		$em->flush();
    	}
    }


    public function updateEtape(Request $request, $clearMissing)
    {

    	$etape = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Etape")
                        ->find($request->get('id'));

        
        $etape->setEtpDateModif(new \DateTime("now"));

        if (empty($etape)) {
            # code...
            return new JsonResponse(['message'=>'Etape not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EtapeType::class, $etape);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($etape);
            $em->flush();
            return $etape;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/etapes/modifier/{id}")
    */
    public function updateEtapeAction(Request $request)
    {
    	return $this->updateEtape($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/etapes/modifier/{id}")
    */
    public function patchEtapeAction(Request $request)
    {
    	return $this->updateEtape($request, false);
    }
}
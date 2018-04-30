<?php 
// src/Cmi/ApiBundle/Controller/Ayant_droitControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Ayant_droitType;
use Cmi\ApiBundle\Entity\Ayant_droit;

class Ayant_droitController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/ayant_droits")
     */
    public function getAyant_droitsAction()
    {

    	$ayant_droits = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Ayant_droit')
                ->findAll();
        /* @var $places Place[] */

         if (empty($ayant_droits)) {
            return new JsonResponse(['message' => 'Ayant_droit not found'], Response::HTTP_NOT_FOUND);
        }

        return $ayant_droits;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/ayant_droits/{id}")
     */
    public function getAyant_droitAction( Request $request)
    {

    	$ayant_droits = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Ayant_droit')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($ayant_droits)) {
            return new JsonResponse(['message' => 'Ayant_droit not found'], Response::HTTP_NOT_FOUND);
        }

        return $ayant_droits;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/ayant_droits")
     */
    public function postAyant_droitsAction(Request $request)
    {

    	$ayant_droit = new Ayant_droit();

        // $ayant_droit->setAyant_droitNumero($request->get("numero"));
        // $ayant_droit->setAyant_droitCode($request->get("code"));
        $ayant_droit->setAyDroitDateEnreg(new \DateTime("now"));
        $ayant_droit->setAyDroitDateModif(new \DateTime("now"));

        $form = $this->createForm(Ayant_droitType::class, $ayant_droit);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($ayant_droit);
            $em->flush();
            return $ayant_droit;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/ayant_droits/{id}")
    */
    public function removeAyant_droitsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$ayant_droit = $em->getRepository('CmiApiBundle:Ayant_droit')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($ayant_droit) {
    		$em->remove($ayant_droit);
    		$em->flush();
    	}

    }



    
    public function updateAyant_droit(Request $request, $clearMissing)
    {
        $ayant_droit = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Ayant_droit")
                        ->find($request->get('id'));

        
        $ayant_droit->setAyDroitDateModif(new \DateTime("now"));

        if (empty($ayant_droit)) {
            # code...
            return new JsonResponse(['message'=>'Ayant_droit not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Ayant_droitType::class, $ayant_droit);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($ayant_droit);
            $em->flush();
            return $ayant_droit;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/ayant_droits/{id}")
    */
    public function updateAyant_droitAction(Request $request)
    {
        return $this->updateAyant_droit($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/ayant_droits/{id}")
    */
    public function patchAyant_droitAction(Request $request)
    {
        return $this->updateAyant_droit($request, false);
    }

}
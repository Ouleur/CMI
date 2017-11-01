<?php 
// src/Cmi/ApiBundle/Controller/PraticienControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PraticienType;
use Cmi\ApiBundle\Entity\Praticien;

class PraticienController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/praticiens")
     */
    public function getPraticiensAction()
    {

    	$praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->findAll();
        /* @var $places Place[] */

         if (empty($praticiens)) {
            return new JsonResponse(['message' => 'Praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $praticiens;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/praticiens/{id}")
     */
    public function getPraticienAction( Request $request)
    {

    	$praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($praticiens)) {
            return new JsonResponse(['message' => 'Praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $praticiens;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/praticiens")
     */
    public function postPraticiensAction(Request $request)
    {

    	$praticien = new Praticien();

        // $praticien->setPraticienNumero($request->get("numero"));
        // $praticien->setPraticienCode($request->get("code"));
        $praticien->setPratDateEnreg(new \DateTime("now"));
        $praticien->setPratDateModif(new \DateTime("now"));

        $form = $this->createForm(PraticienType::class, $praticien);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($praticien);
            $em->flush();
            return $praticien;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/praticiens/{id}")
    */
    public function removePraticiensAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$praticien = $em->getRepository('CmiApiBundle:Praticien')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($praticien) {
    		$em->remove($praticien);
    		$em->flush();
    	}

    }



    
    public function updatePraticien(Request $request, $clearMissing)
    {
        $praticien = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Praticien")
                        ->find($request->get('id'));

        
        $praticien->setPratDateModif(new \DateTime("now"));

        if (empty($praticien)) {
            # code...
            return new JsonResponse(['message'=>'Praticien not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PraticienType::class, $praticien);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($praticien);
            $em->flush();
            return $praticien;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/praticiens/{id}")
    */
    public function updatePraticienAction(Request $request)
    {
        return $this->updatePraticien($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/praticiens/{id}")
    */
    public function patchPraticienAction(Request $request)
    {
        return $this->updatePraticien($request, false);
    }

}
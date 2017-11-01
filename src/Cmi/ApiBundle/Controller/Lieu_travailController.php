<?php 
// src/Cmi/ApiBundle/Controller/Lieu_travailControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Lieu_travailType;
use Cmi\ApiBundle\Entity\Lieu_travail;

class Lieu_travailController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/lieu_travails")
     */
    public function getLieu_travailsAction()
    {

    	$lieu_travails = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Lieu_travail')
                ->findAll();
        /* @var $places Place[] */

         if (empty($lieu_travails)) {
            return new JsonResponse(['message' => 'Lieu_travail not found'], Response::HTTP_NOT_FOUND);
        }

        return $lieu_travails;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/lieu_travails/{id}")
     */
    public function getLieu_travailAction( Request $request)
    {

    	$lieu_travails = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Lieu_travail')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($lieu_travails)) {
            return new JsonResponse(['message' => 'Lieu_travail not found'], Response::HTTP_NOT_FOUND);
        }

        return $lieu_travails;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/lieu_travails")
     */
    public function postLieu_travailsAction(Request $request)
    {

    	$lieu_travail = new Lieu_travail();

        // $lieu_travail->setLieu_travailNumero($request->get("numero"));
        // $lieu_travail->setLieu_travailCode($request->get("code"));
        $lieu_travail->setLTravDateEnreg(new \DateTime("now"));
        $lieu_travail->setLTravDateModif(new \DateTime("now"));

        $form = $this->createForm(Lieu_travailType::class, $lieu_travail);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($lieu_travail);
            $em->flush();
            return $lieu_travail;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/lieu_travails/{id}")
    */
    public function removeLieu_travailsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$lieu_travail = $em->getRepository('CmiApiBundle:Lieu_travail')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($lieu_travail) {
    		$em->remove($lieu_travail);
    		$em->flush();
    	}

    }



    
    public function updateLieu_travail(Request $request, $clearMissing)
    {
        $lieu_travail = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Lieu_travail")
                        ->find($request->get('id'));

        
        $lieu_travail->setLTravDateModif(new \DateTime("now"));

        if (empty($lieu_travail)) {
            # code...
            return new JsonResponse(['message'=>'Lieu_travail not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Lieu_travailType::class, $lieu_travail);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($lieu_travail);
            $em->flush();
            return $lieu_travail;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/lieu_travails/{id}")
    */
    public function updateLieu_travailAction(Request $request)
    {
        return $this->updateLieu_travail($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/lieu_travails/{id}")
    */
    public function patchLieu_travailAction(Request $request)
    {
        return $this->updateLieu_travail($request, false);
    }

}
<?php 
// src/Cmi/ApiBundle/Controller/AutreControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AutreType;
use Cmi\ApiBundle\Entity\Autre;

class AutreController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/autres")
     */
    public function getAutresAction()
    {

    	$autres = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Autre')
                ->findAll();
        /* @var $places Place[] */

         if (empty($autres)) {
            return new JsonResponse(['message' => 'Autre not found'], Response::HTTP_NOT_FOUND);
        }

        return $autres;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/autres/{id}")
     */
    public function getAutreAction( Request $request)
    {

    	$autres = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Autre')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($autres)) {
            return new JsonResponse(['message' => 'Autre not found'], Response::HTTP_NOT_FOUND);
        }

        return $autres;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/autres")
     */
    public function postAutresAction(Request $request)
    {

    	$autre = new Autre();

        // $autre->setAutreNumero($request->get("numero"));
        // $autre->setAutreCode($request->get("code"));
        $autre->setAutreDateEnreg(new \DateTime("now"));
        $autre->setAutreDateModif(new \DateTime("now"));

        $form = $this->createForm(AutreType::class, $autre);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($autre);
            $em->flush();
            return $autre;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/autres/{id}")
    */
    public function removeAutresAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$autre = $em->getRepository('CmiApiBundle:Autre')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($autre) {
    		$em->remove($autre);
    		$em->flush();
    	}

    }



    
    public function updateAutre(Request $request, $clearMissing)
    {
        $autre = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Autre")
                        ->find($request->get('id'));

        
        $autre->setAutreDateModif(new \DateTime("now"));

        if (empty($autre)) {
            # code...
            return new JsonResponse(['message'=>'Autre not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AutreType::class, $autre);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($autre);
            $em->flush();
            return $autre;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/autres/{id}")
    */
    public function updateAutreAction(Request $request)
    {
        return $this->updateAutre($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/autres/{id}")
    */
    public function patchAutreAction(Request $request)
    {
        return $this->updateAutre($request, false);
    }

}
<?php 
// src/Cmi/ApiBundle/Controller/CarteControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CarteType;
use Cmi\ApiBundle\Entity\Carte;

class CarteController extends FOSRestController
{


    /**
     * @Rest\View()
     * @Rest\Get("/cartes")
     */
    public function getCartesAction()
    {

    	$cartes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Carte')
                ->findAll();
        /* @var $places Place[] */

         if (empty($cartes)) {
            return new JsonResponse(['message' => 'Carte not found'], Response::HTTP_NOT_FOUND);
        }

        return $cartes;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/cartes/{id}")
     */
    public function getCarteAction( Request $request)
    {

    	$cartes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Carte')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($cartes)) {
            return new JsonResponse(['message' => 'Carte not found'], Response::HTTP_NOT_FOUND);
        }

        return $cartes;
    

    	//$data = array("Fonction" => "modifier");
        // $view = $this->view($formatted);
        // return $this->handleView($view);
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/cartes")
     */
    public function postCartesAction(Request $request)
    {

    	$carte = new Carte();

        // $carte->setCarteNumero($request->get("numero"));
        // $carte->setCarteCode($request->get("code"));
        $carte->setCarteDateEnreg(new \DateTime("now"));
        $carte->setCarteDateModif(new \DateTime("now"));
        $carte->setCarteDateDelivrance(new \DateTime(date('Y-m-d')));

        $form = $this->createForm(CarteType::class, $carte);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($carte);
            $em->flush();
            return $carte;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/cartes/{id}")
    */
    public function removeCartesAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$carte = $em->getRepository('CmiApiBundle:Carte')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($carte) {
    		$em->remove($carte);
    		$em->flush();
    	}

    }



    /**
    * @Rest\View()
    * @Rest\Put("/cartes/{id}")
    */
    public function updateCarteAction(Request $request)
    {
        $carte = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Carte")
                        ->find($request->get('id'));

        
        $carte->setCarteDateModif(new \DateTime("now"));

        if (empty($carte)) {
            # code...
            return new JsonResponse(['message'=>'Carte not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(CarteType::class, $carte);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($carte);
            $em->flush();
            return $carte;
        }else{
            return $form;
        }
    }
}
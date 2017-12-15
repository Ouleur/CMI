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
     * @Rest\View(serializerGroups={"carte"})
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


    // /**
    //  * @Rest\View()
    //  * @Rest\Get("/assurance/{id}/cartes")
    //  */
    // public function getCartesAction(Request $request)
    // {

    //     $assurance = $this->get('doctrine.orm.entity_manager')
    //             ->getRepository('CmiApiBundle:Assurance')
    //             ->find($request->get("id"));

        
    //      // @var $places Place[] 

    //      if (empty($assurance)) {
    //         return new JsonResponse(['message' => 'Carte not found'], Response::HTTP_NOT_FOUND);
    //     }

    //     return $assurance->getCartes();
    // }



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
    
    }


    // /**
    //  * @Rest\View(statusCode=Response::HTTP_CREATED)
    //  * @Rest\Post("/cartes")
    //  */
    // public function postCartesAction(Request $request)
    // {
    // 	$carte = new Carte();

    //     // $carte->setCarteNumero($request->get("numero"));
    //     // $carte->setCarteCode($request->get("code"));
    //     $carte->setCarteDateEnreg(new \DateTime("now"));
    //     $carte->setCarteDateModif(new \DateTime("now"));
    //     $carte->setCarteDateDelivrance(new \DateTime(date('Y-m-d')));

    //     $form = $this->createForm(CarteType::class, $carte);


    //     $form->submit($request->query->all()); // Validation des données

    //     if ($form->isValid()){
    //         $em = $this->get('doctrine.orm.entity_manager');
    //         $em->persist($carte);
    //         $em->flush();
    //         return $carte;
    //     }else{
    //         return $form;
    //     }   	
    // }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/assurance/{as_id}/patient/{p_id}/cartes")
     */
    public function postCartesAction(Request $request)
    {

        $assurance = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Assurance')
                ->find($request->get("as_id"));

        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get("p_id"));


        $carte = new Carte();

        // $carte->setCarteNumero($request->get("numero"));
        // $carte->setCarteCode($request->get("code"));
        $carte->setCarteDateEnreg(new \DateTime("now"));
        $carte->setCarteDateModif(new \DateTime("now"));
        $carte->setCarteDateDelivrance(new \DateTime(date('Y-m-d')));
        $carte->setAssurance($assurance);
        $carte->setPatient($patient);

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



    
    public function updateCarte(Request $request, $clearMissing)
    {
        $carte = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Carte")
                        ->find($request->get('id'));
        
        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get("p_id"));

        $assurance = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Assurance')
                ->find($request->get("as_id"));


        
        $carte->setCarteDateModif(new \DateTime("now"));

        if (empty($carte)) {
            # code...
            return new JsonResponse(['message'=>'Carte not found'],Response::HTTP_NOT_FOUND);
        }
        
        
        $carte->setPatient($patient);
        $carte->setAssurance($assurance);


        $form = $this->createForm(CarteType::class, $carte);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($carte);
            $em->flush();
            return $carte;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/cartes/{id}")
    */
    public function updateCarteAction(Request $request)
    {
        return $this->updateCarte($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/cartes/{id}")
    */
    public function patchCarteAction(Request $request)
    {
        return $this->updateCarte($request, false);
    }

}
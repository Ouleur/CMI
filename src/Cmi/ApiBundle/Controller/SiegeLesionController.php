<?php 
// src/Cmi/ApiBundle/Controller/SiegeLesionController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\SiegeLesionType;
use Cmi\ApiBundle\Entity\SiegeLesion;

class SiegeLesionController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"siegeLesion"})
     * @Rest\Get("/siegelesions/afficher")
     */
    public function getSiegeLesionsAction()
    {
        $siegelesions = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:SiegeLesion')
                ->findAll();
        /* @var $siegelesions SiegeLesion[] */

         if (empty($siegelesions)) {
            return new JsonResponse(['message' => 'SiegeLesions not found'], Response::HTTP_NOT_FOUND);
        }

        return $siegelesions;
    }

    /**
     * @Rest\View(serializerGroups={"siegeLesion"})
     * @Rest\Get("/siegelesions/rechercher/{id}")
     */
    public function getSiegeLesionAction( Request $request)
    {
        $siegelesion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:SiegeLesion')
                ->find($request->get('id'));
        /* @var $siegelesion SiegeLesion[] */

        if (empty($siegelesion)) {
            return new JsonResponse(['message' => 'SiegeLesion not found'], Response::HTTP_NOT_FOUND);
        }

        return $siegelesion;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"siegeLesion"})
     * @Rest\Post("/siegelesions/creer")
     */
    public function postSiegeLesionAction(Request $request)
    {

        $siegelesion = new SiegeLesion();


        $siegelesion->setSlDateEnreg(new \DateTime("now"));
        $siegelesion->setSlDateModif(new \DateTime("now"));

        $form = $this->createForm(SiegeLesionType::class, $siegelesion);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($siegelesion);
            $em->flush();
            return $siegelesion;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT,serializerGroups={"siegeLesion"})
    * @Rest\Delete("/siegelesions/supprimer/{id}")
    */
    public function removeSiegeLesionAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $siegelesion = $em->getRepository('CmiApiBundle:SiegeLesion')
                    ->find($request->get('id'));
    
         /* @var $siegelesion SiegeLesion */

        if ($siegelesion) {
            $em->remove($siegelesion);
            $em->flush();
        }
    }


    public function updateSiegeLesion(Request $request, $clearMissing)
    {

        $siegelesion = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:SiegeLesion")
                        ->find($request->get('id'));

        
        $siegelesion->setSlDateModif(new \DateTime("now"));

        if (empty($siegelesion)) {
            # code...
            return new JsonResponse(['message'=>'SiegeLesion not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SiegeLesionType::class, $siegelesion);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($siegelesion);
            $em->flush();
            return $siegelesion;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View(serializerGroups={"siegeLesion"})
    * @Rest\Put("/siegelesions/modifier/{id}")
    */
    public function updateSiegeLesionAction(Request $request)
    {
        return $this->updateSiegeLesion($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"siegeLesion"})
    * @Rest\Patch("/siegelesions/modifier/{id}")
    */
    public function patchSiegeLesionAction(Request $request)
    {
        return $this->updateSiegeLesion($request, false);
    }
}
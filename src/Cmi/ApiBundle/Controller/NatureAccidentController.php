<?php 
// src/Cmi/ApiBundle/Controller/NatureAccidentController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\NatureAccidentType;
use Cmi\ApiBundle\Entity\NatureAccident;

class NatureAccidentController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"natureAccident"})
     * @Rest\Get("/natureaccidents/afficher")
     */
    public function getNatureAccidentsAction()
    {
        $natureaccidents = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureAccident')
                ->findAll();
        /* @var $natureaccidents NatureAccident[] */

         if (empty($natureaccidents)) {
            return new JsonResponse(['message' => 'NatureAccidents not found'], Response::HTTP_NOT_FOUND);
        }

        return $natureaccidents;
    }

    /**
     * @Rest\View(serializerGroups={"natureAccident"})
     * @Rest\Get("/natureaccidents/rechercher/{id}")
     */
    public function getNatureAccidentAction( Request $request)
    {
        $natureaccident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureAccident')
                ->find($request->get('id'));
        /* @var $natureaccident NatureAccident[] */

        if (empty($natureaccident)) {
            return new JsonResponse(['message' => 'NatureAccident not found'], Response::HTTP_NOT_FOUND);
        }

        return $natureaccident;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"natureAccident"})
     * @Rest\Post("/natureaccidents/creer")
     */
    public function postNatureAccidentAction(Request $request)
    {

        $natureaccident = new NatureAccident();


        $natureaccident->setNaDateEnreg(new \DateTime("now"));
        $natureaccident->setNaDateModif(new \DateTime("now"));

        $form = $this->createForm(NatureAccidentType::class, $natureaccident);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($natureaccident);
            $em->flush();
            return $natureaccident;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT,serializerGroups={"natureAccident"})
    * @Rest\Delete("/natureaccidents/supprimer/{id}")
    */
    public function removeNatureAccidentAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $natureaccident = $em->getRepository('CmiApiBundle:NatureAccident')
                    ->find($request->get('id'));
    
         /* @var $natureaccident NatureAccident */

        if ($natureaccident) {
            $em->remove($natureaccident);
            $em->flush();
        }
    }


    public function updateNatureAccident(Request $request, $clearMissing)
    {

        $natureaccident = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:NatureAccident")
                        ->find($request->get('id'));

        
        $natureaccident->setNaDateModif(new \DateTime("now"));

        if (empty($natureaccident)) {
            # code...
            return new JsonResponse(['message'=>'NatureAccident not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(NatureAccidentType::class, $natureaccident);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($natureaccident);
            $em->flush();
            return $natureaccident;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View(serializerGroups={"natureAccident"})
    * @Rest\Put("/natureaccidents/modifier/{id}")
    */
    public function updateNatureAccidentAction(Request $request)
    {
        return $this->updateNatureAccident($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"natureAccident"})
    * @Rest\Patch("/natureaccidents/modifier/{id}")
    */
    public function patchNatureAccidentAction(Request $request)
    {
        return $this->updateNatureAccident($request, false);
    }
}
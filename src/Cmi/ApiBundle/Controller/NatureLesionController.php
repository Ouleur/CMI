<?php 
// src/Cmi/ApiBundle/Controller/NatureLesionController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\NatureLesionType;
use Cmi\ApiBundle\Entity\NatureLesion;

class NatureLesionController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/naturelesions/afficher")
     */
    public function getNatureLesionsAction()
    {
        $naturelesions = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureLesion')
                ->findAll();
        /* @var $naturelesions NatureLesion[] */

         if (empty($naturelesions)) {
            return new JsonResponse(['message' => 'NatureLesions not found'], Response::HTTP_NOT_FOUND);
        }

        return $naturelesions;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/naturelesions/rechercher/{id}")
     */
    public function getNatureLesionAction( Request $request)
    {
        $naturelesion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureLesion')
                ->find($request->get('id'));
        /* @var $naturelesion NatureLesion[] */

        if (empty($naturelesion)) {
            return new JsonResponse(['message' => 'NatureLesion not found'], Response::HTTP_NOT_FOUND);
        }

        return $naturelesion;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/naturelesions/creer")
     */
    public function postNatureLesionAction(Request $request)
    {

        $naturelesion = new NatureLesion();


        $naturelesion->setNlDateEnreg(new \DateTime("now"));
        $naturelesion->setNlDateModif(new \DateTime("now"));

        $form = $this->createForm(NatureLesionType::class, $naturelesion);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($naturelesion);
            $em->flush();
            return $naturelesion;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/naturelesions/supprimer/{id}")
    */
    public function removeNatureLesionAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $naturelesion = $em->getRepository('CmiApiBundle:NatureLesion')
                    ->find($request->get('id'));
    
         /* @var $naturelesion NatureLesion */

        if ($naturelesion) {
            $em->remove($naturelesion);
            $em->flush();
        }
    }


    public function updateNatureLesion(Request $request, $clearMissing)
    {

        $naturelesion = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:NatureLesion")
                        ->find($request->get('id'));

        
        $naturelesion->setNlDateModif(new \DateTime("now"));

        if (empty($naturelesion)) {
            # code...
            return new JsonResponse(['message'=>'NatureLesion not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(NatureLesionType::class, $naturelesion);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($naturelesion);
            $em->flush();
            return $naturelesion;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/naturelesions/modifier/{id}")
    */
    public function updateNatureLesionAction(Request $request)
    {
        return $this->updateNatureLesion($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/naturelesions/modifier/{id}")
    */
    public function patchNatureLesionAction(Request $request)
    {
        return $this->updateNatureLesion($request, false);
    }
}
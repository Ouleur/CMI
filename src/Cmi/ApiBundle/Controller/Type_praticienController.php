<?php 
// src/Cmi/ApiBundle/Controller/Type_praticienController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Type_praticienType;
use Cmi\ApiBundle\Entity\Type_praticien;

class Type_praticienController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"type_praticien"})
     * @Rest\Get("/type_praticiens/afficher")
     */
    public function getType_praticiensAction()
    {
    	$type_praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_praticien')
                ->findAll();
        /* @var $type_praticiens Type_praticien[] */

         if (empty($type_praticiens)) {
            return new JsonResponse(['message' => 'Type_praticiens not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_praticiens;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/type_praticiens/rechercher/{id}")
     */
    public function getType_praticienAction( Request $request)
    {
    	$type_praticien = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_praticien')
                ->find($request->get('id'));
        /* @var $type_praticien Type_praticien[] */

        if (empty($type_praticien)) {
            return new JsonResponse(['message' => 'Type_praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_praticien;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/type_praticiens/creer")
     */
    public function postType_praticienAction(Request $request)
    {

    	$type_praticien = new Type_praticien();


        $type_praticien->setTypePraticienDateEnreg(new \DateTime("now"));
        $type_praticien->setTypePraticienDateModif(new \DateTime("now"));

        $form = $this->createForm(Type_praticienType::class, $type_praticien);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($type_praticien);
            $em->flush();
            return $type_praticien;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/type_praticiens/supprimer/{id}")
    */
    public function removeType_praticienAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$type_praticien = $em->getRepository('CmiApiBundle:Type_praticien')
    				->find($request->get('id'));
    
    	 /* @var $type_praticien Type_praticien */

        if ($type_praticien) {
    		$em->remove($type_praticien);
    		$em->flush();
    	}
    }


    public function updateType_praticien(Request $request, $clearMissing)
    {

    	$type_praticien = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_praticien")
                        ->find($request->get('id'));

        
        $type_praticien->setTypePraticienDateModif(new \DateTime("now"));

        if (empty($type_praticien)) {
            # code...
            return new JsonResponse(['message'=>'Type_praticien not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Type_praticienType::class, $type_praticien);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($type_praticien);
            $em->flush();
            return $type_praticien;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/type_praticiens/modifier/{id}")
    */
    public function updateType_praticienAction(Request $request)
    {
    	return $this->updateType_praticien($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/type_praticiens/modifier/{id}")
    */
    public function patchType_praticienAction(Request $request)
    {
    	return $this->updateType_praticien($request, false);
    }
}
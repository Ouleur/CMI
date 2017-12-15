<?php 
// src/Cmi/ApiBundle/Controller/PathologieController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PathologieType;
use Cmi\ApiBundle\Entity\Pathologie;

class PathologieController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"pathologie"})
     * @Rest\Get("/pathologies/afficher")
     */
    public function getPathologiesAction()
    {
    	$pathologies = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->findAll();
        /* @var $pathologies Pathologie[] */

         if (empty($pathologies)) {
            return new JsonResponse(['message' => 'Pathologies not found'], Response::HTTP_NOT_FOUND);
        }

        return $pathologies;
    }

    /**
     * @Rest\View(serializerGroups={"pathologie"})
     * @Rest\Get("/pathologies/rechercher/{id}")
     */
    public function getPathologieAction( Request $request)
    {
    	$pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get('id'));
        /* @var $pathologie Pathologie[] */

        if (empty($pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
        }

        return $pathologie;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"pathologie"})
     * @Rest\Post("/pathologies/creer")
     */
    public function postPathologieAction(Request $request)
    {

    	$pathologie = new Pathologie();

        
        $pathologie->setPathoDateEnreg(new \DateTime("now"));
        $pathologie->setPathoDateModif(new \DateTime("now"));

        $form = $this->createForm(PathologieType::class, $pathologie);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($pathologie);
            $em->flush();
            return $pathologie;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT,serializerGroups={"pathologie"})
    * @Rest\Delete("/pathologies/supprimer/{id}")
    */
    public function removePathologieAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$pathologie = $em->getRepository('CmiApiBundle:Pathologie')
    				->find($request->get('id'));
    
    	 /* @var $pathologie Pathologie */

        if ($pathologie) {
    		$em->remove($pathologie);
    		$em->flush();
    	}

        $em = $this->get('doctrine.orm.entity_manager');
        $pathologie = $em->getRepository('CmiApiBundle:Pathologie');
    }


    public function updatePathologie(Request $request, $clearMissing)
    {

    	$pathologie = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Pathologie")
                        ->find($request->get('id'));

        
        $pathologie->setPathoDateModif(new \DateTime("now"));

        if (empty($pathologie)) {
            # code...
            return new JsonResponse(['message'=>'Pathologie not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PathologieType::class, $pathologie);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($pathologie);
            $em->flush();
            return $pathologie;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View(serializerGroups={"pathologie"})
    * @Rest\Put("/pathologies/modifier/{id}")
    */
    public function updatePathologieAction(Request $request)
    {
    	return $this->updatePathologie($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"pathologie"})
    * @Rest\Patch("/pathologies/modifier/{id}")
    */
    public function patchPathologieAction(Request $request)
    {
    	return $this->updatePathologie($request, false);
    }
}
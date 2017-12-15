<?php 
// src/Cmi/ApiBundle/Controller/Type_contratControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Type_contratType;
use Cmi\ApiBundle\Entity\Type_contrat;

class Type_contratController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"type_contrat"})
     * @Rest\Get("/type_contrats")
     */
    public function getType_contratsAction()
    {

    	$type_contrats = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_contrat')
                ->findAll();
        /* @var $places Place[] */

         if (empty($type_contrats)) {
            return new JsonResponse(['message' => 'Type_contrat not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_contrats;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/type_contrats/{id}")
     */
    public function getType_contratAction( Request $request)
    {

    	$type_contrats = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_contrat')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($type_contrats)) {
            return new JsonResponse(['message' => 'Type_contrat not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_contrats;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/type_contrats")
     */
    public function postType_contratsAction(Request $request)
    {

    	$type_contrat = new Type_contrat();

        // $type_contrat->setType_contratNumero($request->get("numero"));
        // $type_contrat->setType_contratCode($request->get("code"));
        $type_contrat->setTContratDateEnreg(new \DateTime("now"));
        $type_contrat->setTContratDateModif(new \DateTime("now"));

        $form = $this->createForm(Type_contratType::class, $type_contrat);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($type_contrat);
            $em->flush();
            return $type_contrat;
        }else{
            return $form;
        }
    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/type_contrats/{id}")
    */
    public function removeType_contratsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$type_contrat = $em->getRepository('CmiApiBundle:Type_contrat')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($type_contrat) {
    		$em->remove($type_contrat);
    		$em->flush();
    	}

    }



    
    public function updateType_contrat(Request $request, $clearMissing)
    {
        $type_contrat = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_contrat")
                        ->find($request->get('id'));

        
        $type_contrat->setTContratDateModif(new \DateTime("now"));

        if (empty($type_contrat)) {
            # code...
            return new JsonResponse(['message'=>'Type_contrat not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Type_contratType::class, $type_contrat);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($type_contrat);
            $em->flush();
            return $type_contrat;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/type_contrats/{id}")
    */
    public function updateType_contratAction(Request $request)
    {
        return $this->updateType_contrat($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/type_contrats/{id}")
    */
    public function patchType_contratAction(Request $request)
    {
        return $this->updateType_contrat($request, false);
    }

}
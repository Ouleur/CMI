<?php 
// src/Cmi/ApiBundle/Controller/AssuranceControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AssuranceType;
use Cmi\ApiBundle\Entity\Assurance;

class AssuranceController extends FOSRestController
{


    /**
     * @Rest\View()
     * @Rest\Get("/assurances")
     */
    public function getAssurancesAction()
    {

    	$assurances = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Assurance')
                ->findAll();
        /* @var $places Place[] */

         if (empty($assurances)) {
            return new JsonResponse(['message' => 'Assurance not found'], Response::HTTP_NOT_FOUND);
        }

        return $assurances;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/assurances/{id}")
     */
    public function getAssuranceAction( Request $request)
    {

    	$assurances = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Assurance')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($assurances)) {
            return new JsonResponse(['message' => 'Assurance not found'], Response::HTTP_NOT_FOUND);
        }

        return $assurances;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/assurances")
     */
    public function postAssurancesAction(Request $request)
    {

    	$assurance = new Assurance();

        // $assurance->setAssuranceNumero($request->get("numero"));
        // $assurance->setAssuranceCode($request->get("code"));
        $assurance->setAssureDateEnreg(new \DateTime("now"));
        $assurance->setAssureDateModif(new \DateTime("now"));

        $form = $this->createForm(AssuranceType::class, $assurance);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($assurance);
            $em->flush();
            return $assurance;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/assurances/{id}")
    */
    public function removeAssurancesAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$assurance = $em->getRepository('CmiApiBundle:Assurance')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($assurance) {
    		$em->remove($assurance);
    		$em->flush();
    	}

    }



    
    public function updateAssurance(Request $request, $clearMissing)
    {
        $assurance = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Assurance")
                        ->find($request->get('id'));

        
        $assurance->setAssureDateModif(new \DateTime("now"));

        if (empty($assurance)) {
            # code...
            return new JsonResponse(['message'=>'Assurance not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AssuranceType::class, $assurance);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($assurance);
            $em->flush();
            return $assurance;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/assurances/{id}")
    */
    public function updateAssuranceAction(Request $request)
    {
        return $this->updateAssurance($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/assurances/{id}")
    */
    public function patchAssuranceAction(Request $request)
    {
        return $this->updateAssurance($request, false);
    }

}
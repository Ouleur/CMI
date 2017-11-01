<?php 
// src/Cmi/ApiBundle/Controller/ProffessionControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ProffessionType;
use Cmi\ApiBundle\Entity\Proffession;

class ProffessionController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/proffessions")
     */
    public function getProffessionsAction()
    {

    	$proffessions = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Proffession')
                ->findAll();
        /* @var $places Place[] */

         if (empty($proffessions)) {
            return new JsonResponse(['message' => 'Proffession not found'], Response::HTTP_NOT_FOUND);
        }

        return $proffessions;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/proffessions/{id}")
     */
    public function getProffessionAction( Request $request)
    {

    	$proffessions = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Proffession')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($proffessions)) {
            return new JsonResponse(['message' => 'Proffession not found'], Response::HTTP_NOT_FOUND);
        }

        return $proffessions;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/proffessions")
     */
    public function postProffessionsAction(Request $request)
    {

    	$proffession = new Proffession();

        // $proffession->setProffessionNumero($request->get("numero"));
        // $proffession->setProffessionCode($request->get("code"));
        $proffession->setProffDateEnreg(new \DateTime("now"));
        $proffession->setProffDateModif(new \DateTime("now"));

        $form = $this->createForm(ProffessionType::class, $proffession);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($proffession);
            $em->flush();
            return $proffession;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/proffessions/{id}")
    */
    public function removeProffessionsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$proffession = $em->getRepository('CmiApiBundle:Proffession')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($proffession) {
    		$em->remove($proffession);
    		$em->flush();
    	}

    }



    
    public function updateProffession(Request $request, $clearMissing)
    {
        $proffession = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Proffession")
                        ->find($request->get('id'));

        
        $proffession->setProffDateModif(new \DateTime("now"));

        if (empty($proffession)) {
            # code...
            return new JsonResponse(['message'=>'Proffession not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ProffessionType::class, $proffession);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($proffession);
            $em->flush();
            return $proffession;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/proffessions/{id}")
    */
    public function updateProffessionAction(Request $request)
    {
        return $this->updateProffession($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/proffessions/{id}")
    */
    public function patchProffessionAction(Request $request)
    {
        return $this->updateProffession($request, false);
    }

}
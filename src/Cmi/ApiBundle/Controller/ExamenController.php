<?php 
// src/Cmi/ApiBundle/Controller/ExamenControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ExamenType;
use Cmi\ApiBundle\Entity\Examen;

class ExamenController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/examens")
     */
    public function getExamensAction()
    {

    	$examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->findAll();
        /* @var $places Place[] */

         if (empty($examens)) {
            return new JsonResponse(['message' => 'Examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $examens;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/examens/{id}")
     */
    public function getExamenAction( Request $request)
    {

    	$examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($examens)) {
            return new JsonResponse(['message' => 'Examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $examens;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/examens")
     */
    public function postExamensAction(Request $request)
    {

    	$examen = new Examen();

        // $examen->setExamenNumero($request->get("numero"));
        // $examen->setExamenCode($request->get("code"));
        $examen->setExamDateEnreg(new \DateTime("now"));
        $examen->setExamDateModif(new \DateTime("now"));

        $form = $this->createForm(ExamenType::class, $examen);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($examen);
            $em->flush();
            return $examen;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/examens/{id}")
    */
    public function removeExamensAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$examen = $em->getRepository('CmiApiBundle:Examen')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($examen) {
    		$em->remove($examen);
    		$em->flush();
    	}

    }



    
    public function updateExamen(Request $request, $clearMissing)
    {
        $examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Examen")
                        ->find($request->get('id'));

        
        $examen->setExamDateModif(new \DateTime("now"));

        if (empty($examen)) {
            # code...
            return new JsonResponse(['message'=>'Examen not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ExamenType::class, $examen);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($examen);
            $em->flush();
            return $examen;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/examens/{id}")
    */
    public function updateExamenAction(Request $request)
    {
        return $this->updateExamen($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/examens/{id}")
    */
    public function patchExamenAction(Request $request)
    {
        return $this->updateExamen($request, false);
    }

}
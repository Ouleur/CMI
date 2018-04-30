<?php 
// src/Cmi/ApiBundle/Controller/Type_examenControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Type_examenType;
use Cmi\ApiBundle\Entity\Type_examen;

class Type_examenController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"type_examen"})
     * @Rest\Get("/type_examens")
     */
    public function getType_examensAction()
    {

    	$type_examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_examen')
                ->findAll();
        /* @var $places Place[] */

         if (empty($type_examens)) {
            return new JsonResponse(['message' => 'Type_examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_examens;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/type_examens/{id}")
     */
    public function getType_examenAction( Request $request)
    {

    	$type_examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_examen')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($type_examens)) {
            return new JsonResponse(['message' => 'Type_examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_examens;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/type_examens")
     */
    public function postType_examensAction(Request $request)
    {

    	$type_examen = new Type_examen();

        // $type_examen->setType_examenNumero($request->get("numero"));
        // $type_examen->setType_examenCode($request->get("code"));
        $type_examen->setTExamDateEnreg(new \DateTime("now"));
        $type_examen->setTExamDateModif(new \DateTime("now"));

        $form = $this->createForm(Type_examenType::class, $type_examen);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($type_examen);
            $em->flush();
            return $type_examen;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/type_examens/{id}")
    */
    public function removeType_examensAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$type_examen = $em->getRepository('CmiApiBundle:Type_examen')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($type_examen) {
    		$em->remove($type_examen);
    		$em->flush();
    	}

    }



    
    public function updateType_examen(Request $request, $clearMissing)
    {
        $type_examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_examen")
                        ->find($request->get('id'));

        
        $type_examen->setTExamDateModif(new \DateTime("now"));

        if (empty($type_examen)) {
            # code...
            return new JsonResponse(['message'=>'Type_examen not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Type_examenType::class, $type_examen);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($type_examen);
            $em->flush();
            return $type_examen;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/type_examens/{id}")
    */
    public function updateType_examenAction(Request $request)
    {
        return $this->updateType_examen($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/type_examens/{id}")
    */
    public function patchType_examenAction(Request $request)
    {
        return $this->updateType_examen($request, false);
    }

}
<?php 
// src/Cmi/ApiBundle/Controller/Type_patientControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Type_patientType;
use Cmi\ApiBundle\Entity\Type_patient;

class Type_patientController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/type_patient")
     */
    public function getType_patientsAction()
    {

        $type_patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_patient')
                ->findAll();
        /* @var $places Place[] */

         if (empty($type_patient)) {
            return new JsonResponse(['message' => 'Type_patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_patient;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/type_patient/{id}")
     */
    public function getType_patientAction( Request $request)
    {

        $type_patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_patient')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($type_patient)) {
            return new JsonResponse(['message' => 'Type_patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_patient;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/type_patient")
     */
    public function postType_patientsAction(Request $request)
    {

        $autre = new Type_patient();

        // $autre->setType_patientNumero($request->get("numero"));
        // $autre->setType_patientCode($request->get("code"));
        $autre->setTPatDateEnreg(new \DateTime("now"));
        $autre->setTPatDateModif(new \DateTime("now"));

        $form = $this->createForm(Type_patientType::class, $autre);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($autre);
            $em->flush();
            return $autre;
        }else{
            return $form;
        }
        

        


        
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/type_patient/{id}")
    */
    public function removeType_patientsAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $autre = $em->getRepository('CmiApiBundle:Type_patient')
                    ->find($request->get('id'));
    
         /* @var $place Place */

        if ($autre) {
            $em->remove($autre);
            $em->flush();
        }

    }



    
    public function updateType_patient(Request $request, $clearMissing)
    {
        $autre = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_patient")
                        ->find($request->get('id'));

        
        $autre->setTPatDateModif(new \DateTime("now"));

        if (empty($autre)) {
            # code...
            return new JsonResponse(['message'=>'Type_patient not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Type_patientType::class, $autre);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($autre);
            $em->flush();
            return $autre;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/type_patient/{id}")
    */
    public function updateType_patientAction(Request $request)
    {
        return $this->updateType_patient($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/type_patient/{id}")
    */
    public function patchType_patientAction(Request $request)
    {
        return $this->updateType_patient($request, false);
    }

}
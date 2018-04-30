<?php 
// src/Cmi/ApiBundle/Controller/Type_examenRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ExamenType;
use Cmi\ApiBundle\Entity\Type_examen;

class Type_examenRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/examen/afficher")
     */
    public function getExamenRelationAction(Request $request)
    {   
         $examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Examen")
                        ->findAll();

        if (empty($examen)) {
            return new JsonResponse(['message' => 'Examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $examen;
    }


    // Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\POST("/type_examen/{t_id}/examen/creer")
     */
    public function postExamenRelationAction(Request $request)
    {
        $type_examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_examen")
                        ->find($request->get('t_id'));
    

        $examen = new Examen()
        $examen->setTypeExamen($type_examen);

        $examen->setExamDateEnreg(new \DateTime("now"));
        $examen->setExamDateModif(new \DateTime("now"));

        if (empty($examen)) {
            return new JsonResponse(['message' => 'Examen not found'], Response::HTTP_NOT_FOUND);
        }

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




    public function updateExamenType_examen(Request $request, $clearMissing)
    {
        $examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Examen")
                        ->find($request->get('id'));

        
        $examen->setExamDateModif(new \DateTime("now"));

        if (empty($examen)) {
            # code...
            return new JsonResponse(['message'=>'Examen not found'],Response::HTTP_NOT_FOUND);
        }


        $type_examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Type_examen")
                        ->find($request->get('tex_id'));

                
        $examen->setTypeExamen($type_examen);

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
    * @Rest\Put("/examen/{id}/type_examen/{tex_id}")
    */
    public function updateExamenType_examenAction(Request $request)
    {
        return $this->updateExamenType_examen($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/examen/{id}/type_examen/{tex_id}")
    */
    public function patchExamenType_examenAction(Request $request)
    {
        return $this->updateExamenType_examen($request, false);
    }
}
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
use Cmi\ApiBundle\Entity\Type_examen;

class ExamenController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"examen"})
     * @Rest\Get("/examens/afficher")
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
     * @Rest\View(serializerGroups={"examen"})
     * @Rest\Get("/examens/selection")
     */
    public function getExamensSelectionAction()
    {

        $praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->findAll();
        /* @var $praticiens Motif[] */

         if (empty($praticiens)) {
            return new JsonResponse(['message' => 'Examens not found'], Response::HTTP_NOT_FOUND);
        }

        for ($i=0; $i < count($praticiens); $i++) { 
            # code...
            $json[] = ['id'=>$praticiens[$i]->getId(), 'text'=>$praticiens[$i]->getExamLibelle()];

        }

        return new JsonResponse($json);
    }

    /**
     * @Rest\View(serializerGroups={"examen"})
     * @Rest\Get("/examens/rechercher/{id}")
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
     * @Rest\View(serializerGroups={"examen"},statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/type_examen/{te_id}/examens/creer")
     */
    public function postExamensAction(Request $request)
    {

    	
        $type_examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_examen')
                ->find($request->get('te_id'));

        if (empty($type_examens)) {
            return new JsonResponse(['message'=>$type_examens],Response::HTTP_NOT_FOUND);
           
        }

        $examen = new Examen();
        $examen->setTypeExamen($type_examens);
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
    * @Rest\View(serializerGroups={"examen"},statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/examens/supprimer/{id}")
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
        $type_examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_examen')
                ->find($request->get('te_id'));

        if (empty($type_examens)) {
            return new JsonResponse(['message'=>$type_examens],Response::HTTP_NOT_FOUND);
           
        }

        $examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->find($request->get('id'));

        if (empty($type_examens)) {
            return new JsonResponse(['message'=>$examens],Response::HTTP_NOT_FOUND);
           
        }

        $examens->setTypeExamen($type_examens);
        // $examens->setExamenNumero($request->get("numero"));
        // $examens->setExamenCode($request->get("code"));
        $examens->setExamDateModif(new \DateTime("now"));

        $form = $this->createForm(ExamenType::class, $examens);
        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($examens);
            $em->flush();
            return $examens;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View(serializerGroups={"examen"})
    * @Rest\Put("/type_examen/{te_id}/examens/modifier/{id}")
    */
    public function updateExamenAction(Request $request)
    {
        return $this->updateExamen($request, true);
    }


    /**
    * @Rest\View(serializerGroups={"examen"})
    * @Rest\Patch("/type_examen/{te_id}/examens/modifier/{id}")
    */
    public function patchExamenAction(Request $request)
    {
        return $this->updateExamen($request, false);
    }

}
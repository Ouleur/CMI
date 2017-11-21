<?php 
// src/Cmi/ApiBundle/Controller/MotifController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\MotifType;
use Cmi\ApiBundle\Entity\Motif;

class MotifController extends FOSRestController
{

	/**
     * @Rest\View()
     * @Rest\Get("/motifs/afficher")
     */
    public function getMotifsAction()
    {
    	$motifs = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Motif')
                ->findAll();
        /* @var $motifs Motif[] */

         if (empty($motifs)) {
            return new JsonResponse(['message' => 'Motifs not found'], Response::HTTP_NOT_FOUND);
        }

        return $motifs;
    }



    /**
     * @Rest\View()
     * @Rest\Get("/motifs/selection")
     */
    public function getMotifsSelectAction()
    {
        $motifs = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Motif')
                ->findAll();
        /* @var $motifs Motif[] */

         if (empty($motifs)) {
            return new JsonResponse(['message' => 'Motifs not found'], Response::HTTP_NOT_FOUND);
        }

        for ($i=0; $i < count($motifs); $i++) { 
            # code...
            $json[] = ['id'=>$motifs[$i]->getId(), 'text'=>$motifs[$i]->getMotifLibelle()];

        }

        return new JsonResponse($json);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/motifs/rechercher/{id}")
     */
    public function getMotifAction( Request $request)
    {
    	$motif = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Motif')
                ->find($request->get('id'));
        /* @var $motif Motif[] */

        if (empty($motif)) {
            return new JsonResponse(['message' => 'Motif not found'], Response::HTTP_NOT_FOUND);
        }

        return $motif;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/motifs/creer")
     */
    public function postMotifAction(Request $request)
    {

    	$motif = new Motif();


        $motif->setMotifDateEnreg(new \DateTime("now"));
        $motif->setMotifDateModif(new \DateTime("now"));

        $form = $this->createForm(MotifType::class, $motif);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($motif);
            $em->flush();
            return $motif;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/motifs/supprimer/{id}")
    */
    public function removeMotifAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$motif = $em->getRepository('CmiApiBundle:Motif')
    				->find($request->get('id'));
    
    	 /* @var $motif Motif */

        if ($motif) {
    		$em->remove($motif);
    		$em->flush();
    	}
    }


    public function updateMotif(Request $request, $clearMissing)
    {

    	$motif = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Motif")
                        ->find($request->get('id'));

        
        $motif->setMotifDateModif(new \DateTime("now"));

        if (empty($motif)) {
            # code...
            return new JsonResponse(['message'=>'Motif not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(MotifType::class, $motif);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($motif);
            $em->flush();
            return $motif;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/motifs/modifier/{id}")
    */
    public function updateMotifAction(Request $request)
    {
    	return $this->updateMotif($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/motifs/modifier/{id}")
    */
    public function patchMotifAction(Request $request)
    {
    	return $this->updateMotif($request, false);
    }
}
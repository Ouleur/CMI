<?php 
// src/Cmi/ApiBundle/Controller/PraticienControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PraticienType;
use Cmi\ApiBundle\Entity\Praticien;

class PraticienController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"praticien"})
     * @Rest\Get("/praticiens/afficher")
     */
    public function getPraticiensAction()
    {

    	$praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->findAll();
        /* @var $places Place[] */

         if (empty($praticiens)) {
            return new JsonResponse(['message' => 'Praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $praticiens;
    }

    /**
     * @Rest\View(serializerGroups={"praticien"})
     * @Rest\Get("/praticiens/{id}")
     */
    public function getPraticienAction( Request $request)
    {

    	$praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($praticiens)) {
            return new JsonResponse(['message' => 'Praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $praticiens;
    
    }

     /**
     * @Rest\View(serializerGroups={"praticien"})
     * @Rest\Get("/praticienSearch")
     */
    public function getPraticienSearchAction(Request $request)
    {
        # code...
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $patients = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Praticien')
        ->createQueryBuilder('c')
        ->where($qb->expr()->like("c.pratNom",$qb->expr()->literal('%' . $request->get('phrase') . '%')))
        // ->setParameters(array("mtr"=>$request->get('phrase')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();

         if (empty($patients)) {
            return new JsonResponse(['message' => 'Praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    }

    /**
     * @Rest\View(serializerGroups={"praticien"})
     * @Rest\Get("/praticien/selection")
     */
    public function getPraticiensSelectAction()
    {
        $praticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Praticien')
                ->findAll();
        /* @var $praticiens Motif[] */

         if (empty($praticiens)) {
            return new JsonResponse(['message' => 'Praticiens not found'], Response::HTTP_NOT_FOUND);
        }

        for ($i=0; $i < count($praticiens); $i++) { 
            # code...
            $json[] = ['id'=>$praticiens[$i]->getId(), 'text'=>$praticiens[$i]->getPratNom()." ".$praticiens[$i]->getPratPrenoms()];

        }

        return new JsonResponse($json);
    }


    /**
     * @Rest\View(serializerGroups={"praticien"},statusCode=Response::HTTP_CREATED)
     * @Rest\Post("type_praticien/{tp_id}/praticiens/creer")
     */
    public function postPraticiensAction(Request $request)
    {

        $type_raticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_praticien')
                ->find($request->get('tp_id'));

    	$praticien = new Praticien();
        $praticien->setTypePraticien($type_raticiens);

        // $praticien->setPraticienNumero($request->get("numero"));
        // $praticien->setPraticienCode($request->get("code"));
        $praticien->setPratDateEnreg(new \DateTime("now"));
        $praticien->setPratDateModif(new \DateTime("now"));

        if (empty($type_raticiens)) {
            return new JsonResponse(['message' => 'Type Praticien not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PraticienType::class, $praticien);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($praticien);
            $em->flush();
            return $praticien;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(serializerGroups={"praticien"},statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/praticiens/{id}")
    */
    public function removePraticiensAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$praticien = $em->getRepository('CmiApiBundle:Praticien')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($praticien) {
    		$em->remove($praticien);
    		$em->flush();
    	}

    }



    
    public function updatePraticien(Request $request, $clearMissing)
    {

        $type_raticiens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_praticien')
                ->find($request->get('tp_id'));

        if (empty($type_raticiens)) {
            # code...
            return new JsonResponse(['message'=>'Type Praticien not found'],Response::HTTP_NOT_FOUND);
        }

        $praticien = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Praticien")
                        ->find($request->get('id'));

        if (empty($praticien)) {
            # code...
            return new JsonResponse(['message'=>'Praticien not found'],Response::HTTP_NOT_FOUND);
        }

        $praticien->setTypePraticien($type_raticiens);

        
        $praticien->setPratDateModif(new \DateTime("now"));

        

        $form = $this->createForm(PraticienType::class, $praticien);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($praticien);
            $em->flush();
            return $praticien;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View(serializerGroups={"praticien"})
    * @Rest\Put("type_praticien/{tp_id}/praticiens/{id}")
    */
    public function updatePraticienAction(Request $request)
    {
        return $this->updatePraticien($request, true);
    }


    /**
    * @Rest\View(serializerGroups={"praticien"})
    * @Rest\Patch("type_praticien/{tp_id}/praticiens/{id}")
    */
    public function patchPraticienAction(Request $request)
    {
        return $this->updatePraticien($request, false);
    }

}
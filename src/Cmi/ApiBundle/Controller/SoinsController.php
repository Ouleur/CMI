<?php 
// src/Cmi/ApiBundle/Controller/SoinsController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\SoinsType;
use Cmi\ApiBundle\Entity\Soins;

class SoinsController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"soins"})
     * @Rest\Get("/soins/afficher")
     */
    public function getSoinsAction()
    {
    	$soins = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Soins')
                ->findAll();
        /* @var $soins Soins[] */

         if (empty($soins)) {
            return new JsonResponse(['message' => 'Soins not found'], Response::HTTP_NOT_FOUND);
        }

        return $soins;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/soins/rechercher/{id}")
     */
    public function getSoinAction( Request $request)
    {
    	$soin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Soins')
                ->find($request->get('id'));
        /* @var $soin Soins[] */

        if (empty($soin)) {
            return new JsonResponse(['message' => 'Soin not found'], Response::HTTP_NOT_FOUND);
        }

        return $soin;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("consultation/{c_id}/acte/{a_id}/soins/creer")
     */
    public function postSoinsAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('c_id'));


        $acte = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Acte')
                ->find($request->get('a_id'));


    	$soin = new Soins();

        $soin->setActe($acte);
        $soin->setConsultation($consultation);


        $soin->setSoinsDateEnreg(new \DateTime("now"));
        $soin->setSoinsDateModif(new \DateTime("now"));

        $form = $this->createForm(SoinsType::class, $soin);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($soin);
            $em->flush();
            return $soin;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/soins/supprimer/{id}")
    */
    public function removeSoinsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$soin = $em->getRepository('CmiApiBundle:Soins')
    				->find($request->get('id'));
    
    	 /* @var $soin Soins */

        if ($soin) {
    		$em->remove($soin);
    		$em->flush();
    	}
    }


    public function updateSoins(Request $request, $clearMissing)
    {
        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Conultation')
                ->find($request->get('c_id'));


        $acte = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Acte')
                ->find($request->get('a_id'));



    	$soin = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Soins")
                        ->find($request->get('id'));

        $soin->setActe($acte);
        $soin->setConsultation($consultation);

        
        $soin->setSoinsDateModif(new \DateTime("now"));

        if (empty($soin)) {
            # code...
            return new JsonResponse(['message'=>'Soin not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SoinsType::class, $soin);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($soin);
            $em->flush();
            return $soin;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/consultation/{c_id}/acte/{a_id}/soins/modifier/{id}")
    */
    public function updateSoinsAction(Request $request)
    {
    	return $this->updateSoins($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{c_id}/acte/{a_id}/soins/modifier/{id}")
    */
    public function patchSoinsAction(Request $request)
    {
    	return $this->updateSoins($request, false);
    }
}
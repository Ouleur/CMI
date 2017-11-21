<?php 
// src/Cmi/ApiBundle/Controller/OrdonnanceController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\OrdonnanceType;
use Cmi\ApiBundle\Entity\Ordonnance;

class OrdonnanceController extends FOSRestController
{

	/**
     * @Rest\View()
     * @Rest\Get("/ordonnances/afficher")
     */
    public function getordonnancesAction()
    {
    	$ordonnances = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Ordonnance')
                ->findAll();
        /* @var $ordonnances Ordonnance[] */

         if (empty($ordonnances)) {
            return new JsonResponse(['message' => 'Ordonnances not found'], Response::HTTP_NOT_FOUND);
        }

        return $ordonnances;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/ordonnances/rechercher/{id}")
     */
    public function getOrdonnanceAction( Request $request)
    {
    	$ordonnance = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Ordonnance')
                ->find($request->get('id'));
        /* @var $ordonnance Ordonnance[] */

        if (empty($ordonnance)) {
            return new JsonResponse(['message' => 'Ordonnance not found'], Response::HTTP_NOT_FOUND);
        }

        return $ordonnance;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/consultation/{c_id}/medicament/{m_id}/ordonnances/creer")
     */
    public function postOrdonnanceAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('id'));

        $medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medicament')
                ->find($request->get('id'));


    	$ordonnance = new Ordonnance();

        
        $ordonnance->setConsultation($consultation);
        $ordonnance->setMedicament($medicament);
        $ordonnance->setOrdoDateEnreg(new \DateTime("now"));
        $ordonnance->setOrdoDateModif(new \DateTime("now"));

        $form = $this->createForm(OrdonnanceType::class, $ordonnance);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($ordonnance);
            $em->flush();
            return $ordonnance;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/ordonnances/supprimer/{id}")
    */
    public function removeOrdonnanceAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$ordonnance = $em->getRepository('CmiApiBundle:Ordonnance')
    				->find($request->get('id'));
    
    	 /* @var $ordonnance Ordonnance */

        if ($ordonnance) {
    		$em->remove($ordonnance);
    		$em->flush();
    	}
    }


    public function updateOrdonnance(Request $request, $clearMissing)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('id'));

        $medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medicament')
                ->find($request->get('id'));


    	$ordonnance = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Ordonnance")
                        ->find($request->get('id'));

        $ordonnance->setConsultation($consultation);
        $ordonnance->setMedicament($medicament);

        
        $ordonnance->setOrdoDateModif(new \DateTime("now"));

        if (empty($ordonnance)) {
            # code...
            return new JsonResponse(['message'=>'Ordonnance not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(OrdonnanceType::class, $ordonnance);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($ordonnance);
            $em->flush();
            return $ordonnance;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/consultation/{c_id}/medicament/{m_id}/ordonnances/modifier/{id}")
    */
    public function updateOrdonnanceAction(Request $request)
    {
    	return $this->updateOrdonnance($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{c_id}/medicament/{m_id}/ordonnances/modifier/{id}")
    */
    public function patchOrdonnanceAction(Request $request)
    {
    	return $this->updateOrdonnance($request, false);
    }
}
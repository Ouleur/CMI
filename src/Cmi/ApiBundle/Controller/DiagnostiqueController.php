<?php 
// src/Cmi/ApiBundle/Controller/DiagnostiqueController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\DiagnostiqueType;
use Cmi\ApiBundle\Entity\Diagnostique;

class DiagnostiqueController extends FOSRestController
{

	/**
     * @Rest\View(serializerGroups={"diagnostique"})
     * @Rest\Get("/diagnostiques/afficher")
     */
    public function getDiagnostiquesAction()
    {
    	$diagnostiques = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Diagnostique')
                ->findAll();
        /* @var $diagnostiques Diagnostique[] */

         if (empty($diagnostiques)) {
            return new JsonResponse(['message' => 'Diagnostiques not found'], Response::HTTP_NOT_FOUND);
        }

        return $diagnostiques;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/diagnostiques/rechercher/{id}")
     */
    public function getDiagnostiqueAction( Request $request)
    {
    	$diagnostique = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Diagnostique')
                ->find($request->get('id'));
        /* @var $diagnostique Diagnostique[] */

        if (empty($diagnostique)) {
            return new JsonResponse(['message' => 'Diagnostique not found'], Response::HTTP_NOT_FOUND);
        }

        return $diagnostique;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/consultation/{c_id}/cause/{ca_id}/pathologie/{pa_id}/diagnostiques/creer")
     */
    public function postDiagnostiqueAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('c_id'));

        $cause = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Cause')
                ->find($request->get('ca_id'));

        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get('pa_id'));

    	$diagnostique = new Diagnostique();

        
        $diagnostique->setPathologie($pathologie);
        $diagnostique->setCause($cause);
        $diagnostique->setConsultation($consultation);
        $diagnostique->setDiagnDateEnreg(new \DateTime("now"));
        $diagnostique->setDiagnDateModif(new \DateTime("now"));

        $form = $this->createForm(DiagnostiqueType::class, $diagnostique);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($diagnostique);
            $em->flush();
            return $diagnostique;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/diagnostiques/supprimer/{id}")
    */
    public function removeDiagnostiqueAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$diagnostique = $em->getRepository('CmiApiBundle:Diagnostique')
    				->find($request->get('id'));
    
    	 /* @var $diagnostique Diagnostique */

        if ($diagnostique) {
    		$em->remove($diagnostique);
    		$em->flush();
    	}
    }


    public function updateDiagnostique(Request $request, $clearMissing)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('c_id'));

        $cause = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Cause')
                ->find($request->get('ca_id'));

        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get('pa_id'));

    	$diagnostique = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Diagnostique")
                        ->find($request->get('id'));
        
        $diagnostique->setPathologie($pathologie);
        $diagnostique->setCause($cause);
        $diagnostique->setConsultation($consultation);
        
        $diagnostique->setDiagnDateModif(new \DateTime("now"));

        if (empty($diagnostique)) {
            # code...
            return new JsonResponse(['message'=>'Diagnostique not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DiagnostiqueType::class, $diagnostique);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($diagnostique);
            $em->flush();
            return $diagnostique;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/consultation/{c_id}/cause/{ca_id}/pathologie/{pa_id}/diagnostiques/modifier/{id}")
    */
    public function updateDiagnostiqueAction(Request $request)
    {
    	return $this->updateDiagnostique($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{c_id}/cause/{ca_id}/pathologie/{pa_id}/diagnostiques/modifier/{id}")
    */
    public function patchDiagnostiqueAction(Request $request)
    {
    	return $this->updateDiagnostique($request, false);
    }
}
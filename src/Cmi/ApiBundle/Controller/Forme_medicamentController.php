<?php 
// src/Cmi/ApiBundle/Controller/Forme_medicamentController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Forme_medicamentType;
use Cmi\ApiBundle\Entity\Forme_medicament;

class Forme_medicamentController extends FOSRestController
{

	/**
     *@Rest\View(serializerGroups={"form_medic"})
     * @Rest\Get("/formes_medicaments/afficher")
     */
    public function getFormesMedicamentsAction()
    {
    	$formes_medicaments = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Forme_medicament')
                ->findAll();
        /* @var $formes_medicaments Forme_medicament[] */

         if (empty($formes_medicaments)) {
            return new JsonResponse(['message' => 'Formes de médicament not found'], Response::HTTP_NOT_FOUND);
        }

        return $formes_medicaments;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/formes_medicaments/rechercher/{id}")
     */
    public function getFormeMedicamentAction( Request $request)
    {
    	$forme_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Forme_medicament')
                ->find($request->get('id'));
        /* @var $forme_medicament Forme_medicament[] */

        if (empty($forme_medicament)) {
            return new JsonResponse(['message' => 'Forme de medicament not found'], Response::HTTP_NOT_FOUND);
        }

        return $forme_medicament;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/formes_medicaments/creer")
     */
    public function postFormeMedicamentAction(Request $request)
    {

    	$forme_medicament = new Forme_medicament();

        
        $forme_medicament->setFormMedicDateEnreg(new \DateTime("now"));
        $forme_medicament->setFormMedicDateModif(new \DateTime("now"));

        $form = $this->createForm(Forme_medicamentType::class, $forme_medicament);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($forme_medicament);
            $em->flush();
            return $forme_medicament;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/formes_medicaments/supprimer/{id}")
    */
    public function removeFormeMedicamentAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$forme_medicament = $em->getRepository('CmiApiBundle:Forme_medicament')
    				->find($request->get('id'));
    
    	 /* @var $forme_medicament Forme_medicament */

        if ($forme_medicament) {
    		$em->remove($forme_medicament);
    		$em->flush();
    	}
    }


    public function updateFormeMedicament(Request $request, $clearMissing)
    {

    	$forme_medicament = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Forme_medicament")
                        ->find($request->get('id'));

        
        $forme_medicament->setFormMedicDateModif(new \DateTime("now"));

        if (empty($forme_medicament)) {
            # code...
            return new JsonResponse(['message'=>'Forme de médicament not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Forme_medicamentType::class, $forme_medicament);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($forme_medicament);
            $em->flush();
            return $forme_medicament;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/formes_medicaments/modifier/{id}")
    */
    public function updateFormeMedicamentAction(Request $request)
    {
    	return $this->updateFormeMedicament($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/formes_medicaments/modifier/{id}")
    */
    public function patchFormeMedicamentAction(Request $request)
    {
    	return $this->updateFormeMedicament($request, false);
    }
}
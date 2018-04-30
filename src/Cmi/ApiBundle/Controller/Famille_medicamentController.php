<?php 
// src/Cmi/ApiBundle/Controller/Famille_medicamentController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Famille_medicamentType;
use Cmi\ApiBundle\Entity\Famille_medicament;

class Famille_medicamentController extends FOSRestController
{

	/**
     *@Rest\View(serializerGroups={"fam_medicament"})
     * @Rest\Get("/familles_medicaments/afficher")
     */
    public function getFamillesMedicamentsAction()
    {
    	$familles_medicaments = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_medicament')
                ->findAll();
        /* @var $familles_medicaments Famille_medicament[] */

         if (empty($familles_medicaments)) {
            return new JsonResponse(['message' => 'Familles de médicament not found'], Response::HTTP_NOT_FOUND);
        }

        return $familles_medicaments;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/familles_medicaments/rechercher/{id}")
     */
    public function getFamilleMedicamentAction( Request $request)
    {
    	$famille_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_medicament')
                ->find($request->get('id'));
        /* @var $etape Etape[] */

        if (empty($famille_medicament)) {
            return new JsonResponse(['message' => 'Famille de médicament not found'], Response::HTTP_NOT_FOUND);
        }

        return $famille_medicament;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/familles_medicaments/creer")
     */
    public function postFamilleMedicamentAction(Request $request)
    {

    	$famille_medicament = new Famille_medicament();

        
        $famille_medicament->setFamMedicDateEnreg(new \DateTime("now")); 
        $famille_medicament->setFamMedicDateModif(new \DateTime("now"));

        $form = $this->createForm(Famille_medicamentType::class, $famille_medicament);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($famille_medicament);
            $em->flush();
            return $famille_medicament;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/familles_medicaments/supprimer/{id}")
    */
    public function removeFamilleMedicamentAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$famille_medicament = $em->getRepository('CmiApiBundle:Famille_medicament')
    				->find($request->get('id'));
    
    	 /* @var $famille_medicament Famille_medicament */

        if ($famille_medicament) {
    		$em->remove($famille_medicament);
    		$em->flush();
    	}
    }


    public function updateFamilleMedicament(Request $request, $clearMissing)
    {

    	$famille_medicament = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Famille_medicament")
                        ->find($request->get('id'));

        
        $famille_medicament->setFamMedicDateModif(new \DateTime("now"));

        if (empty($famille_medicament)) {
            # code...
            return new JsonResponse(['message'=>'Famille de médicament not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Famille_medicamentType::class, $famille_medicament);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($famille_medicament);
            $em->flush();
            return $famille_medicament;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/familles_medicaments/modifier/{id}")
    */
    public function updateFamilleMedicamentAction(Request $request)
    {
    	return $this->updateFamilleMedicament($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/familles_medicaments/creer/{id}")
    */
    public function patchFamilleMedicamentAction(Request $request)
    {
    	return $this->updateFamilleMedicament($request, false);
    }
}
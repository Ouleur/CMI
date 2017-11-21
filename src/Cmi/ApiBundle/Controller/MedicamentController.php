<?php 
// src/Cmi/ApiBundle/Controller/MedicamentController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\MedicamentType;
use Cmi\ApiBundle\Entity\Medicament;

class MedicamentController extends FOSRestController
{

	/**
     * @Rest\View()
     * @Rest\Get("/medicaments/afficher")
     */
    public function getsMedicamentsAction()
    {
    	$medicaments = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medicament')
                ->findAll();
        /* @var $medicaments Medicament[] */

         if (empty($medicaments)) {
            return new JsonResponse(['message' => 'Medicaments not found'], Response::HTTP_NOT_FOUND);
        }

        return $medicaments;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/medicaments/rechercher/{id}")
     */
    public function getMedicamentAction( Request $request)
    {
    	$medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medicament')
                ->find($request->get('id'));
        /* @var $medicament Medicament[] */

        if (empty($medicament)) {
            return new JsonResponse(['message' => 'Medicament not found'], Response::HTTP_NOT_FOUND);
        }

        return $medicament;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/famille_medicament/{f_id}/forme_medicament/{fo_id}/medicaments/creer")
     */
    public function postMedicamentAction(Request $request)
    {

        $famille_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_medicament')
                ->find($request->get('f_id'));

        if (empty($famille_medicament)) {
            return new JsonResponse(['message' => 'Famille Medicament not found'], Response::HTTP_NOT_FOUND);
        }

        $forme_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Forme_medicament')
                ->find($request->get('fo_id'));

        if (empty($forme_medicament)) {
            return new JsonResponse(['message' => 'Forme Medicament not found'], Response::HTTP_NOT_FOUND);
        }

    	$medicament = new Medicament();

        $medicament->setFormeMedicament($forme_medicament);
        $medicament->setFamilleMedicament($famille_medicament);

        $medicament->setMedicDateEnreg(new \DateTime("now")); 
        $medicament->setMedicDateModif(new \DateTime("now"));

        $form = $this->createForm(MedicamentType::class, $medicament);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($medicament);
            $em->flush();
            return $medicament;
        }else{
            return $form;
        }
    	

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/medicaments/supprimer/{id}")
    */
    public function removeMedicamentAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$medicament = $em->getRepository('CmiApiBundle:Medicament')
    				->find($request->get('id'));
    
    	 /* @var $medicament Medicament */

        if ($medicament) {
    		$em->remove($medicament);
    		$em->flush();
    	}
    }


    public function updateMedicament(Request $request, $clearMissing)
    {

        $famille_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_medicament')
                ->find($request->get('f_id'));

        if (empty($famille_medicament)) {
            return new JsonResponse(['message' => 'Famille Medicament not found'], Response::HTTP_NOT_FOUND);
        }

        $forme_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Forme_medicament')
                ->find($request->get('fo_id'));

        if (empty($forme_medicament)) {
            return new JsonResponse(['message' => 'Forme Medicament not found'], Response::HTTP_NOT_FOUND);
        }


    	$medicament = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Medicament")
                        ->find($request->get('id'));

        $medicament->setFormeMedicament($forme_medicament);
        $medicament->setFamilleMedicament($famille_medicament);

        $medicament->setMedicDateModif(new \DateTime("now"));

        if (empty($medicament)) {
            # code...
            return new JsonResponse(['message'=>'Medicament not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(MedicamentType::class, $medicament);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($medicament);
            $em->flush();
            return $medicament;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/famille_medicament/{f_id}/forme_medicament/{fo_id}/medicaments/modifier/{id}")
    */
    public function updateMedicamentAction(Request $request)
    {
    	return $this->updateMedicament($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/famille_medicament/{f_id}/forme_medicament/{fo_id}/medicaments/modifier/{id}")
    */
    public function patchMedicamentAction(Request $request)
    {
    	return $this->updateMedicament($request, false);
    }
}
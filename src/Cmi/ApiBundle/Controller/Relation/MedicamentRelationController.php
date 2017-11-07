<?php 
// src/Cmi/ApiBundle/Controller/Relation/MedicamentRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Famille_medicament;
use Cmi\ApiBundle\Entity\Medicament;

class MedicamentRelationController extends FOSRestController
{


	// Pharmacien
    /**
     * @Rest\View()
     * @Rest\Get("/famille_medicament/{id}/forme_medicament/{fmid}/medicament")
     */
    public function getMedicamentRelationAction(Request $request)
    {

        $famille_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_medicament')
                ->find($request->get("id"));

        
        $forme_medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Forme_medicament')
                ->find($request->get("fmid"));

        if (empty($forme_medicament)) {
            return new JsonResponse(['message' => 'Forme_medicament not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($famille_medicament)) {
            return new JsonResponse(['message' => 'Type_praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $famille_medicament->getMedicaments();
    }

}
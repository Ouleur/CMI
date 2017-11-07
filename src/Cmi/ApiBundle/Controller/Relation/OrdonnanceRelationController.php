<?php 
// src/Cmi/ApiBundle/Controller/Relation/OrdonnanceRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Medicament;
use Cmi\ApiBundle\Entity\Ordonnance;

class OrdonnanceRelationController extends FOSRestController
{


	// Pharmacien
    /**
     * @Rest\View()
     * @Rest\Get("/medicament/{id}/consultation/{cid}/ordonnance")
     */
    public function getOrdonnanceConsultationAction(Request $request)
    {

        $medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medicament')
                ->find($request->get("id"));

        
        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("pid"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($type_praticien)) {
            return new JsonResponse(['message' => 'Type_praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $medicament->getOrdonnances();
    }

}
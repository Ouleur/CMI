<?php 
// src/Cmi/ApiBundle/Controller/SoinsRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\SoinsType;
use Cmi\ApiBundle\Entity\Soins;

class SoinsRelationController extends FOSRestController
{


	// Pour recuperer les cartes des consultations
    /**
     * @Rest\View()
     * @Rest\Get("/consultation/{id}/acte/{at_id}/soins")
     */
    public function getSoinsConsultationAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("id"));

        
        $acte = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Acte')
                ->find($request->get("at_id"));

        if (empty($acte)) {
            return new JsonResponse(['message' => 'Acte not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation->getSoins();
    }
}
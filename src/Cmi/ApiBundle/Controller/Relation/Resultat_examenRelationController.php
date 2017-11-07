<?php 
// src/Cmi/ApiBundle/Controller/Resultat_examenRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Resltat_examenType;
use Cmi\ApiBundle\Entity\Resltat_examen;

class Resultat_examenRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/consultation/{id}/examen/{exid}/resultat")
     */
    public function getConsultationResultatExamenAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("id"));

        
        $examen = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->find($request->get("exid"));

        if (empty($examen)) {
            return new JsonResponse(['message' => 'Examen not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return $consultation->addResultatExamen();
    }
}
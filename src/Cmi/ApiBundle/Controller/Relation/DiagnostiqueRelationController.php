<?php 
// src/Cmi/ApiBundle/Controller/Relation/DiagnostiqueRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CarteType;
use Cmi\ApiBundle\Entity\Carte;

class DiagnostiqueRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/cause/{id}/pathologie/{pid}/consultaion/{cid}/diagnostique")
     */
    public function getDiagnostiqueRelationAction(Request $request)
    {

        $cause = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Causes')
                ->find($request->get("id"));

        
        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get("pid"));

        $consultaion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultaion')
                ->find($request->get("cid"));

        if (empty($consultaion)) {
            return new JsonResponse(['message' => 'Consultaion not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($cause)) {
            return new JsonResponse(['message' => 'Causes not found'], Response::HTTP_NOT_FOUND);
        }

        return $cause->getDiagnostiques();
    }
}
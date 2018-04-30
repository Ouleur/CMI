<?php 
// src/Cmi/ApiBundle/Controller/CarteControler.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CarteType;
use Cmi\ApiBundle\Entity\Carte;

class CarteRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/assurance/{id}/patient/{pid}/cartes")
     */
    public function getCartesAssuranceAction(Request $request)
    {

        $assurance = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Assurance')
                ->find($request->get("id"));

        
        $patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get("pid"));

        if (empty($patient)) {
            return new JsonResponse(['message' => 'Carte not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($assurance)) {
            return new JsonResponse(['message' => 'Carte not found'], Response::HTTP_NOT_FOUND);
        }

        return $assurance->getCartes();
    }
}
<?php 
// src/Cmi/ApiBundle/Controller/PraticienRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CarteType;
use Cmi\ApiBundle\Entity\Carte;

class PraticienRelationController extends FOSRestController
{


	// Pharmacien
    /**
     * @Rest\View()
     * @Rest\Get("/type_praticien/{id}/consultation/{cid}/pharmacien")
     */
    public function getPharmacienConsultationAction(Request $request)
    {

        $type_praticien = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_praticien')
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

        return $type_praticien->getPraticien();
    }



    // Medecin
    /**
     * @Rest\View()
     * @Rest\Get("/type_praticien/{id}/consultation/{cid}/medecin")
     */
    public function getMedecinConsultatoionAction(Request $request)
    {

        $type_praticien = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Assurance')
                ->find($request->get("id"));

        
        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("cid"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($type_praticien)) {
            return new JsonResponse(['message' => 'Type_praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_praticien->getPraticien();
    }


    // Infirmier
    /**
     * @Rest\View()
     * @Rest\Get("/type_praticien/{id}/consultation/{cid}/infirmier")
     */
    public function getInfirmierConsultationAction(Request $request)
    {

        $type_praticien = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_praticien')
                ->find($request->get("id"));

        
        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get("cid"));

        if (empty($consultation)) {
            return new JsonResponse(['message' => 'Carte not found'], Response::HTTP_NOT_FOUND);
        }

        /* @var $places Place[] */
        if (empty($type_praticien)) {
            return new JsonResponse(['message' => 'Type_praticien not found'], Response::HTTP_NOT_FOUND);
        }

        return $type_praticien->getPraticien();
    }
}
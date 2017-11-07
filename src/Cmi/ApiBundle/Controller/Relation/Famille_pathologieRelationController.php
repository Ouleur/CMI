<?php 
// src/Cmi/ApiBundle/Controller/Relation/Famille_pathologieRelationController.php

namespace Cmi\ApiBundle\Controller\Relation;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PathologieType;
use Cmi\ApiBundle\Entity\Famille_pathologie;

class Famille_pathologieRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/pathologie/{id}/famille_pathologie")
     */
    public function getEtapeRelationAction(Request $request)
    {

        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get("id"));

        if (empty($pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
        }

        return $pathologie->getFamillePathologie();
    }



    public function updatePathologieFamille(Request $request, $clearMissing)
    {
        $pathologie = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Pathologie")
                        ->find($request->get('id'));

        
        $pathologie->setPathoDateModif(new \DateTime("now"));

        if (empty($pathologie)) {
            # code...
            return new JsonResponse(['message'=>'Pathologie not found'],Response::HTTP_NOT_FOUND);
        }


        $famille_pathologie = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Famille_pathologie")
                        ->find($request->get('fp_id'));

                
        $pathologie->setFamillePathologie($famille_pathologie);

        $form = $this->createForm(PathologieType::class, $pathologie);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($pathologie);
            $em->flush();
            return $pathologie;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/pathologie/{id}/famille_pathologie/{fp_id}")
    */
    public function updatePathologieEtapeAction(Request $request)
    {
        return $this->updatePathologieFamille($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/pathologie/{id}/famille_pathologie/{et_id}")
    */
    public function patchPathologieEtapeAction(Request $request)
    {
        return $this->updatePathologieFamille($request, false);
    }
}
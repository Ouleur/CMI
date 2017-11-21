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
use Cmi\ApiBundle\Entity\Pathologie;

class Famille_pathologieRelationController extends FOSRestController
{


	// Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/famille_pathologie/{id}/pathologie")
     */
    public function getFamillePathologieRelationAction(Request $request)
    {

        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get("id"));

        if (empty($pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
        }

        return $pathologie->getFamillePathologie();
    }


    // Pour recuperer les cartes des assurances
    /**
     * @Rest\View()
     * @Rest\Get("/pathologie/afficher")
     */
    public function getPathologieRelationAction(Request $request)
    {

        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->findAll();

        if (empty($pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
        }

        return $pathologie;
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/familles_pathologies/{id}/pathologie/creer")
     */
    public function postFamillePathologieRelationAction(Request $request)
    {
        $famille_pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_pathologie')
                ->find($request->get("id"));

        if (empty($famille_pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
            
        }

        $pathologie = new Pathologie();

        
        $pathologie->setFamillePathologie($famille_pathologie);
        $pathologie->setPathoDateEnreg(new \DateTime("now"));
        $pathologie->setPathoDateModif(new \DateTime("now"));
    

        $form = $this->createForm(PathologieType::class, $pathologie);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($pathologie);
            $em->flush();
            return $pathologie;
        }else{
            return $form;
        }
        

    }



    public function updatePathologieFamille(Request $request, $clearMissing)
    {
        $famille_pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Famille_pathologie')
                ->find($request->get("fp_id"));

        if (empty($famille_pathologie)) {
            return new JsonResponse(['message' => 'Pathologie not found'], Response::HTTP_NOT_FOUND);
            
        }

        $pathologie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Pathologie')
                ->find($request->get("id"));

        
        $pathologie->setFamillePathologie($famille_pathologie);
        $pathologie->setPathoDateModif(new \DateTime("now"));
    

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
    * @Rest\Put("/famille_pathologie/{fp_id}/pathologie/modifier/{id}")
    */
    public function updatePathologieEtapeAction(Request $request)
    {
        return $this->updatePathologieFamille($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/famille_pathologie/{fp_id}/pathologie/modifier/{id}")
    */
    public function patchPathologieEtapeAction(Request $request)
    {
        return $this->updatePathologieFamille($request, false);
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"place"})
     * @Rest\Delete("/pathologie/supprimer/{id}")
     */
    public function removePathologieAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $pathologie = $em->getRepository('CmiApiBundle:Pathologie')
                    ->find($request->get('id'));
        /* @var $place Place */

        // foreach ($place->getPrices() as $price) {
        //     $em->remove($price);
        // }
        
    
         /* @var $place Place */

        if ($pathologie) {
            $em->remove($pathologie);
            $em->flush();
        }
    }
}
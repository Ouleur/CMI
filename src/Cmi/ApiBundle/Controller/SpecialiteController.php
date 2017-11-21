<?php 
// src/Cmi/ApiBundle/Controller/SpecialiteController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\SpecialiteType;
use Cmi\ApiBundle\Entity\Specialite;

class SpecialiteController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"specialite"})
     * @Rest\Get("/specialites/afficher")
     */
    public function getSpecialitesAction()
    {
        $specialites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Specialite')
                ->findAll();
        /* @var $specialites Specialite[] */

         if (empty($specialites)) {
            return new JsonResponse(['message' => 'Specialites not found'], Response::HTTP_NOT_FOUND);
        }

        return $specialites;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/specialites/rechercher/{id}")
     */
    public function getSpecialiteAction( Request $request)
    {
        $specialite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Specialite')
                ->find($request->get('id'));
        /* @var $specialite Specialite[] */

        if (empty($specialite)) {
            return new JsonResponse(['message' => 'Specialite not found'], Response::HTTP_NOT_FOUND);
        }

        return $specialite;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/specialites/creer")
     */
    public function postSpecialiteAction(Request $request)
    {

        $specialite = new Specialite();


        $specialite->setSpDateEnreg(new \DateTime("now"));
        $specialite->setSpDateModif(new \DateTime("now"));

        $form = $this->createForm(SpecialiteType::class, $specialite);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($specialite);
            $em->flush();
            return $specialite;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/specialites/supprimer/{id}")
    */
    public function removeSpecialiteAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $specialite = $em->getRepository('CmiApiBundle:Specialite')
                    ->find($request->get('id'));
    
         /* @var $specialite Specialite */

        if ($specialite) {
            $em->remove($specialite);
            $em->flush();
        }
    }


    public function updateSpecialite(Request $request, $clearMissing)
    {

        $specialite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Specialite")
                        ->find($request->get('id'));

        
        $specialite->setSpDateModif(new \DateTime("now"));

        if (empty($specialite)) {
            # code...
            return new JsonResponse(['message'=>'Specialite not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SpecialiteType::class, $specialite);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($specialite);
            $em->flush();
            return $specialite;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/specialites/modifier/{id}")
    */
    public function updateSpecialiteAction(Request $request)
    {
        return $this->updateSpecialite($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/specialites/modifier/{id}")
    */
    public function patchSpecialiteAction(Request $request)
    {
        return $this->updateSpecialite($request, false);
    }
}
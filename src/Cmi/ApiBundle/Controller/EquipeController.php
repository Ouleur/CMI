<?php 
// src/Cmi/ApiBundle/Controller/EquipeController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\EquipeType;
use Cmi\ApiBundle\Entity\Equipe;

class EquipeController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"equipe"})
     * @Rest\Get("/equipes/afficher")
     */
    public function getEquipesAction()
    {
        $equipes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Equipe')
                ->findAll();
        /* @var $equipes Equipe[] */

         if (empty($equipes)) {
            return new JsonResponse(['message' => 'Equipes not found'], Response::HTTP_NOT_FOUND);
        }

        return $equipes;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/equipes/rechercher/{id}")
     */
    public function getEquipeAction( Request $request)
    {
        $equipe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Equipe')
                ->find($request->get('id'));
        /* @var $equipe Equipe[] */

        if (empty($equipe)) {
            return new JsonResponse(['message' => 'Equipe not found'], Response::HTTP_NOT_FOUND);
        }

        return $equipe;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/equipes/creer")
     */
    public function postEquipeAction(Request $request)
    {

        $equipe = new Equipe();


        $equipe->setEqDateEnreg(new \DateTime("now"));
        $equipe->setEqDateModif(new \DateTime("now"));

        $form = $this->createForm(EquipeType::class, $equipe);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($equipe);
            $em->flush();
            return $equipe;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/equipes/supprimer/{id}")
    */
    public function removeEquipeAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $equipe = $em->getRepository('CmiApiBundle:Equipe')
                    ->find($request->get('id'));
    
         /* @var $equipe Equipe */

        if ($equipe) {
            $em->remove($equipe);
            $em->flush();
        }
    }


    public function updateEquipe(Request $request, $clearMissing)
    {

        $equipe = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Equipe")
                        ->find($request->get('id'));

        
        $equipe->setEqDateModif(new \DateTime("now"));

        if (empty($equipe)) {
            # code...
            return new JsonResponse(['message'=>'Equipe not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EquipeType::class, $equipe);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($equipe);
            $em->flush();
            return $equipe;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/equipes/modifier/{id}")
    */
    public function updateEquipeAction(Request $request)
    {
        return $this->updateEquipe($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/equipes/modifier/{id}")
    */
    public function patchEquipeAction(Request $request)
    {
        return $this->updateEquipe($request, false);
    }
}
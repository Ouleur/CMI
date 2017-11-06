<?php 
// src/Cmi/ApiBundle/Controller/ActeController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ActeType;
use Cmi\ApiBundle\Entity\Acte;

class ActeController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/actes/afficher")
     */
    public function getActesAction()
    {
        $actes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Acte')
                ->findAll();
        /* @var $actes Acte[] */

         if (empty($actes)) {
            return new JsonResponse(['message' => 'Actes not found'], Response::HTTP_NOT_FOUND);
        }

        return $actes;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/actes/rechercher/{id}")
     */
    public function getActeAction( Request $request)
    {
        $acte = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Acte')
                ->find($request->get('id'));
        /* @var $acte Acte[] */

        if (empty($acte)) {
            return new JsonResponse(['message' => 'Acte not found'], Response::HTTP_NOT_FOUND);
        }

        return $acte;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/actes/creer")
     */
    public function postActeAction(Request $request)
    {

        $acte = new Acte();


        $acte->setActeDateEnreg(new \DateTime("now"));
        $acte->setActeDateModif(new \DateTime("now"));

        $form = $this->createForm(ActeType::class, $acte);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($acte);
            $em->flush();
            return $acte;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/actes/supprimer/{id}")
    */
    public function removeActeAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $acte = $em->getRepository('CmiApiBundle:Acte')
                    ->find($request->get('id'));
    
         /* @var $acte Acte */

        if ($acte) {
            $em->remove($acte);
            $em->flush();
        }
    }


    public function updateActe(Request $request, $clearMissing)
    {

        $acte = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Acte")
                        ->find($request->get('id'));

        
        $acte->setActeDateModif(new \DateTime("now"));

        if (empty($acte)) {
            # code...
            return new JsonResponse(['message'=>'Acte not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ActeType::class, $acte);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($acte);
            $em->flush();
            return $acte;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/actes/modifier/{id}")
    */
    public function updateActeAction(Request $request)
    {
        return $this->updateActe($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/actes/modifier/{id}")
    */
    public function patchActeAction(Request $request)
    {
        return $this->updateActe($request, false);
    }
}
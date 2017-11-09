<?php 
// src/Cmi/ApiBundle/Controller/SecteurController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\SecteurType;
use Cmi\ApiBundle\Entity\Secteur;

class SecteurController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/secteurs/afficher")
     */
    public function getSecteursAction()
    {
        $secteurs = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Secteur')
                ->findAll();
        /* @var $secteurs Secteur[] */

         if (empty($secteurs)) {
            return new JsonResponse(['message' => 'Secteurs not found'], Response::HTTP_NOT_FOUND);
        }

        return $secteurs;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/secteurs/rechercher/{id}")
     */
    public function getSecteurAction( Request $request)
    {
        $secteur = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Secteur')
                ->find($request->get('id'));
        /* @var $secteur Secteur[] */

        if (empty($secteur)) {
            return new JsonResponse(['message' => 'Secteur not found'], Response::HTTP_NOT_FOUND);
        }

        return $secteur;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/secteurs/creer")
     */
    public function postSecteurAction(Request $request)
    {

        $secteur = new Secteur();


        $secteur->setSecDateEnreg(new \DateTime("now"));
        $secteur->setSecDateModif(new \DateTime("now"));

        $form = $this->createForm(SecteurType::class, $secteur);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($secteur);
            $em->flush();
            return $secteur;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/secteurs/supprimer/{id}")
    */
    public function removeSecteurAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $secteur = $em->getRepository('CmiApiBundle:Secteur')
                    ->find($request->get('id'));
    
         /* @var $secteur Secteur */

        if ($secteur) {
            $em->remove($secteur);
            $em->flush();
        }
    }


    public function updateSecteur(Request $request, $clearMissing)
    {

        $secteur = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Secteur")
                        ->find($request->get('id'));

        
        $secteur->setSecDateModif(new \DateTime("now"));

        if (empty($secteur)) {
            # code...
            return new JsonResponse(['message'=>'Secteur not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SecteurType::class, $secteur);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($secteur);
            $em->flush();
            return $secteur;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/secteurs/modifier/{id}")
    */
    public function updateSecteurAction(Request $request)
    {
        return $this->updateSecteur($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/secteurs/modifier/{id}")
    */
    public function patchSecteurAction(Request $request)
    {
        return $this->updateSecteur($request, false);
    }
}
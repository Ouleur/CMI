<?php 
// src/Cmi/ApiBundle/Controller/ActiviteController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ActiviteType;
use Cmi\ApiBundle\Entity\Activite;

class ActiviteController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/activites/afficher")
     */
    public function getActivitesAction()
    {
        $activites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Activite')
                ->findAll();
        /* @var $activites Activite[] */

         if (empty($activites)) {
            return new JsonResponse(['message' => 'Activites not found'], Response::HTTP_NOT_FOUND);
        }

        return $activites;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/activites/rechercher/{id}")
     */
    public function getActiviteAction( Request $request)
    {
        $activite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Activite')
                ->find($request->get('id'));
        /* @var $activite Activite[] */

        if (empty($activite)) {
            return new JsonResponse(['message' => 'Activite not found'], Response::HTTP_NOT_FOUND);
        }

        return $activite;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/activites/creer")
     */
    public function postActiviteAction(Request $request)
    {

        $activite = new Activite();


        $activite->setActDateEnreg(new \DateTime("now"));
        $activite->setActDateModif(new \DateTime("now"));

        $form = $this->createForm(ActiviteType::class, $activite);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($activite);
            $em->flush();
            return $activite;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/activites/supprimer/{id}")
    */
    public function removeActiviteAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $activite = $em->getRepository('CmiApiBundle:Activite')
                    ->find($request->get('id'));
    
         /* @var $activite Activite */

        if ($activite) {
            $em->remove($activite);
            $em->flush();
        }
    }


    public function updateActivite(Request $request, $clearMissing)
    {

        $activite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Activite")
                        ->find($request->get('id'));

        
        $activite->setActDateModif(new \DateTime("now"));

        if (empty($activite)) {
            # code...
            return new JsonResponse(['message'=>'Activite not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ActiviteType::class, $activite);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($activite);
            $em->flush();
            return $activite;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/activites/modifier/{id}")
    */
    public function updateActiviteAction(Request $request)
    {
        return $this->updateActivite($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/activites/modifier/{id}")
    */
    public function patchActiviteAction(Request $request)
    {
        return $this->updateActivite($request, false);
    }
}
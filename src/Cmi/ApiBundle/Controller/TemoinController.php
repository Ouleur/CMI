<?php 
// src/Cmi/ApiBundle/Controller/TemoinController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\TemoinType;
use Cmi\ApiBundle\Entity\Temoin;

class TemoinController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"temoin","accident"})
     * @Rest\Get("/temoins/afficher")
     */
    public function getTemoinAction()
    {
        $temoins = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Temoin')
                ->findAll();
        /* @var $temoins Temoin[] */

         if (empty($temoins)) {
            return new JsonResponse(['message' => 'Temoin not found'], Response::HTTP_NOT_FOUND);
        }

        return $temoins;
    }

    /**
     * @Rest\View(serializerGroups={"temoin","accident"})
     * @Rest\Get("/temoin/selection")
     */
    public function getTemoinSelectAction()
    {
        $temoins = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Temoin')
                ->findAll();
        /* @var $temoins Temoin[] */

         if (empty($temoins)) {
            return new JsonResponse(['message' => 'Temoin not found'], Response::HTTP_NOT_FOUND);
        }

        for ($i=0; $i < count($temoins); $i++) { 
            # code...
            $json[] = ['id'=>$temoins[$i]->getId(), 'text'=>$temoins[$i]->getTemoinLibelle()];

        }

        return new JsonResponse($json);
    }

    /**
     * @Rest\View(serializerGroups={"temoin","accident"})
     * @Rest\Get("/temoins/rechercher/{id}")
     */
    public function getTemoinSearchAction( Request $request)
    {
        $temoin = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Temoin')
                ->find($request->get('id'));
        /* @var $temoin Temoin[] */

        if (empty($temoin)) {
            return new JsonResponse(['message' => 'Temoin not found'], Response::HTTP_NOT_FOUND);
        }

        return $temoin;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"temoin"})
     * @Rest\Post("/consultation/{c_id}/temoins/creer")
     */
    public function postTemoinAction(Request $request)
    {   
        $accident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AccidentTravail')
                ->find($request->get('c_id'));

        $temoin = new Temoin();
        $temoin->setAccident($accident);

        $temoin->setTmDateEnreg(new \DateTime("now"));
        $temoin->setTmDateModif(new \DateTime("now"));

        $form = $this->createForm(TemoinType::class, $temoin);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($temoin);
            $em->flush();
            return $temoin;
            //return new JsonResponse(['message' => 'Temoin créer'], Response::HTTP_NOT_FOUND);
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(serializerGroups={"temoin","accident"},statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/temoins/supprimer/{id}")
    */
    public function removeTemoinAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $temoin = $em->getRepository('CmiApiBundle:Temoin')
                    ->find($request->get('id'));
    
         /* @var $temoin Temoin */

        if ($temoin) {
            $em->remove($temoin);
            $em->flush();
        }
    }


    public function updateTemoin(Request $request, $clearMissing)
    {

        $temoin = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Temoin")
                        ->find($request->get('id'));

        
        $temoin->setTemoinDateModif(new \DateTime("now"));

        if (empty($temoin)) {
            # code...
            return new JsonResponse(['message'=>'Temoin not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(TemoinType::class, $temoin);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($temoin);
            $em->flush();
            return $temoin;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View(serializerGroups={"temoin","accident"})
    * @Rest\Put("/temoins/modifier/{id}")
    */
    public function updateTemoinAction(Request $request)
    {
        return $this->updateTemoin($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"temoin","accident"})
    * @Rest\Patch("/temoins/modifier/{id}")
    */
    public function patchTemoinAction(Request $request)
    {
        return $this->updateTemoin($request, false);
    }
}
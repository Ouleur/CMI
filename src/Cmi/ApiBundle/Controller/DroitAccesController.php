<?php 
// src/Cmi/ApiBundle/Controller/DroitAccesController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\DroitAccesType;
use Cmi\ApiBundle\Entity\DroitAcces;

class DroitAccesController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"droitAcces"})
     * @Rest\Get("/droitAccess/afficher")
     */
    public function getDroitAccessAction()
    {
        $droitAccess = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:DroitAcces')
                ->findAll();
        /* @var $droitAccess DroitAcces[] */

         if (empty($droitAccess)) {
            return new JsonResponse(['message' => 'DroitAccess not found'], Response::HTTP_NOT_FOUND);
        }

        return $droitAccess;
    }

    /**
     * @Rest\View(serializerGroups={"droitAcces"})
     * @Rest\Get("/droitAcces/selection")
     */
    public function getDroitAccessSelectAction()
    {
        $droitAccess = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:DroitAcces')
                ->findAll();
        /* @var $droitAccess DroitAcces[] */

         if (empty($droitAccess)) {
            return new JsonResponse(['message' => 'DroitAccess not found'], Response::HTTP_NOT_FOUND);
        }

        for ($i=0; $i < count($droitAccess); $i++) { 
            # code...
            $json[] = ['id'=>$droitAccess[$i]->getId(), 'text'=>$droitAccess[$i]->getDroitAccesLibelle()];

        }

        return new JsonResponse($json);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/droitAccess/rechercher/{id}")
     */
    public function getDroitAccesAction( Request $request)
    {
        $droitAcces = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:DroitAcces')
                ->find($request->get('id'));
        /* @var $droitAcces DroitAcces[] */

        if (empty($droitAcces)) {
            return new JsonResponse(['message' => 'DroitAcces not found'], Response::HTTP_NOT_FOUND);
        }

        return $droitAcces;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/user/{uid}/droitAccess/creer")
     */
    public function postDroitAccesAction(Request $request)
    {

        $droitAcces = new DroitAcces();

        $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:User')
                ->find($request->get('uid'));

        $droitAcces->setUser($user);
        $droitAcces->setDaDateEnreg(new \DateTime("now"));
        $droitAcces->setDaDateModif(new \DateTime("now"));

        $form = $this->createForm(DroitAccesType::class, $droitAcces);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($droitAcces);
            $em->flush();
            //return $droitAcces;
            return new JsonResponse(['message' => 'DroitAccess créer'], Response::HTTP_NOT_FOUND);
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/droitAccess/supprimer/{id}")
    */
    public function removeDroitAccesAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $droitAcces = $em->getRepository('CmiApiBundle:DroitAcces')
                    ->find($request->get('id'));
    
         /* @var $droitAcces DroitAcces */

        if ($droitAcces) {
            $em->remove($droitAcces);
            $em->flush();
        }
    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/droitAccess/supprimer/user/{uid}")
    */
    public function removeDroitAccesAllAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $droitAcces = $em->getRepository('CmiApiBundle:DroitAcces')
                    ->createQueryBuilder('p')
                    ->where("p.user=:uid")
                    ->setParameters(array("uid"=>$request->get('uid')))
                    ->getQuery()
                    ->execute();
    
         /* @var $droitAcces DroitAcces */

        for ($i=0; $i < count($droitAcces); $i++) { 
            # code...
            $em->remove($droitAcces[$i]);
            $em->flush();
        }
    }


    public function updateDroitAcces(Request $request, $clearMissing)
    {

        $droitAcces = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:DroitAcces")
                        ->find($request->get('id'));

        
        $droitAcces->setDaDateModif(new \DateTime("now"));

        if (empty($droitAcces)) {
            # code...
            return new JsonResponse(['message'=>'DroitAcces not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DroitAccesType::class, $droitAcces);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($droitAcces);
            $em->flush();
            return $droitAcces;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/droitAccess/modifier/{id}")
    */
    public function updateDroitAccesAction(Request $request)
    {
        return $this->updateDroitAcces($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/droitAccess/modifier/{id}")
    */
    public function patchDroitAccesAction(Request $request)
    {
        return $this->updateDroitAcces($request, false);
    }
}
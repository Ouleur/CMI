<?php 
// src/Cmi/ApiBundle/Controller/ArretController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ArretType;
use Cmi\ApiBundle\Entity\Arret;

class ArretController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"arret"})
     * @Rest\Get("/arrets/afficher")
     */
    public function getarretsAction()
    {
        $arrets = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Arret')
                ->findAll();
        /* @var $arrets Arret[] */

         if (empty($arrets)) {
            return new JsonResponse(['message' => 'Arrets not found'], Response::HTTP_NOT_FOUND);
        }

        return $arrets;
    }

    /**
     * @Rest\View(serializerGroups={"arret"})
     * @Rest\Get("/arrets/rechercher/{id}")
     */
    public function getArretAction( Request $request)
    {
        $arret = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Arret')
                ->find($request->get('id'));
        /* @var $arret Arret[] */

        if (empty($arret)) {
            return new JsonResponse(['message' => 'Arret not found'], Response::HTTP_NOT_FOUND);
        }


        return $arret;
    }

    private function postArretAction(Request $request)
    {


        $arret = new Arret();

        if ($request->has('c_id')) {
            # code...
            $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('c_id'));
            $arret->setConsultation($consultation);

        }
           
        
        $arret->setArretDateEnreg(new \DateTime("now"));
        $arret->setArretDateModif(new \DateTime("now"));

        $form = $this->createForm(ArretType::class, $arret);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($arret);
            $em->flush();
            return $form;
        }else{
            return $form;
        }
        

    }

    /**
     * @Rest\View(serializerGroups={"arret"},statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/consultation/{c_id}/arrets/creer")
     */
    public function postArretConsultationAction(Request $request)
    {
        $arret = new Arret();

        $consultation = $this->get('doctrine.orm.entity_manager')
            ->getRepository('CmiApiBundle:Consultation')
            ->find($request->get('c_id'));
        $arret->setConsultation($consultation);          
        
        $arret->setArretDateEnreg(new \DateTime("now"));
        $arret->setArretDateModif(new \DateTime("now"));

        $form = $this->createForm(ArretType::class, $arret);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($arret);
            $em->flush();
            return $arret;
        }else{
            return $form;
        }
    }

    /**
     * @Rest\View(serializerGroups={"arret"},statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/accident/{a_id}/arrets/creer")
     */
    public function postArretAccidentAction(Request $request)
    {
        $arret = new Arret();
        # code...
        $accident = $this->get('doctrine.orm.entity_manager')
            ->getRepository('CmiApiBundle:AccidentTravail')
            ->find($request->get('a_id'));

        $arret->setAccident($accident);
    
        


        
        $arret->setArretDateEnreg(new \DateTime("now"));
        $arret->setArretDateModif(new \DateTime("now"));

        $form = $this->createForm(ArretType::class, $arret);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($arret);
            $em->flush();
            return $arret;
        }else{
            return $form;
        }
    }



    /**
    * @Rest\View(serializerGroups={"arret"},statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/arrets/supprimer/{id}")
    */
    public function removeArretAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $arret = $em->getRepository('CmiApiBundle:Arret')
                    ->find($request->get('id'));
    
         /* @var $arret Arret */

        if ($arret) {
            $em->remove($arret);
            $em->flush();
        }
    }


    public function updateArret(Request $request, $clearMissing)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('id'));

        $medicament = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Medicament')
                ->find($request->get('id'));


        $arret = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Arret")
                        ->find($request->get('id'));

        $arret->setConsultation($consultation);
        $arret->setMedicament($medicament);

        
        $arret->setArretDateModif(new \DateTime("now"));

        if (empty($arret)) {
            # code...
            return new JsonResponse(['message'=>'Arret not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ArretType::class, $arret);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($arret);
            $em->flush();
            return $arret;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View(serializerGroups={"arret"})
    * @Rest\Put("/accident/{a_id}/consultation/{c_id}/arrets/modifier/{id}")
    */
    public function updateArretAction(Request $request)
    {
        return $this->updateArret($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"arret"})
    * @Rest\Patch("/accident/{a_id}/consultation/{c_id}/arrets/modifier/{id}")
    */
    public function patchArretAction(Request $request)
    {
        return $this->updateArret($request, false);
    }

    public function updateAccidentArret(Request $request, $clearMissing)
    {

        $accident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AccidentTravail')
                ->find($request->get('a_id'));


        $arret = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Arret")
                        ->find($request->get('id'));

        $arret->setAccident($accident);

        
        $arret->setArretDateModif(new \DateTime("now"));

        if (empty($arret)) {
            # code...
            return new JsonResponse(['message'=>'Arret not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ArretType::class, $arret);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($arret);
            $em->flush();
            return $arret;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View(serializerGroups={"arret"})
    * @Rest\Put("/accident/{a_id}/arrets/modifier/{id}")
    */
    public function updateArretAccidentAction(Request $request)
    {
        return $this->updateAccidentArret($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"arret"})
    * @Rest\Patch("/accident/{a_id}/arrets/modifier/{id}")
    */
    public function patchArretAccidentAction(Request $request)
    {
        return $this->updateAccidentArret($request, false);
    }
}
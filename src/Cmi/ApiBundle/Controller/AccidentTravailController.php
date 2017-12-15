<?php 
// src/Cmi/ApiBundle/Controller/AccindentTravailController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\AccidentTravailType;
use Cmi\ApiBundle\Entity\AccidentTravail;

class AccidentTravailController extends FOSRestController
{


    /**
     * @Rest\View(serializerGroups={"accident"})
     * @Rest\Get("/accident/afficher")
     */
    public function getAccidentsAction()
    {
        $accident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AccidentTravail')
                ->findAll();
        /* @var $accident Accident[] */

         if (empty($accident)) {
            return new JsonResponse(['message' => 'Accidents not found'], Response::HTTP_NOT_FOUND);
        }

        return $accident;
    }

    /**
     * @Rest\View(serializerGroups={"accident"})
     * @Rest\Get("/accident/rechercher/{id}")
     */
    public function getAccidentAction( Request $request)
    {
        $secteur = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AccidentTravail')
                ->find($request->get('id'));
        /* @var $secteur Accident[] */

        if (empty($secteur)) {
            return new JsonResponse(['message' => 'Accident not found'], Response::HTTP_NOT_FOUND);
        }

        return $secteur;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED,serializerGroups={"accident"})
     * @Rest\Post("/agent/{a_id}/equipe/{e_id}/natureLesion/{nl_id}/siegeLesion/{sl_id}/agentMateriel/{am_id}/secteur/{sec_id}/natureAccident/{na_id}/activite/{act_id}/accident/creer")
     */
    public function postAccidentAction(Request $request)
    {

        $accident = new AccidentTravail();

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('a_id'));
        $accident->setPatient($agent);

        $equipe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Equipe')
                ->find($request->get('e_id'));
        $accident->setEquipe($equipe);


        $natureLesion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureLesion')
                ->find($request->get('nl_id'));
        $accident->setNatureLesion($natureLesion);


        $agentMateriel = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AgentMateriel')
                ->find($request->get('am_id'));
        $accident->setAgentMateriel($agentMateriel);


        $secteur = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:secteur')
                ->find($request->get('sec_id'));
        $accident->setSecteur($secteur);


        $natureAccident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureAccident')
                ->find($request->get('na_id'));
        $accident->setNatureAccident($natureAccident);


        $siegeLesion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:SiegeLesion')
                ->find($request->get('sl_id'));
        $accident->setSiegeLesion($siegeLesion);


        $activite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Activite')
                ->find($request->get('act_id'));
        $accident->setActivite($activite);


        $accident->setAtDateEnreg(new \DateTime("now"));
        $accident->setAtDateModif(new \DateTime("now"));

        if (empty($accident)) {
            # code...
            return new JsonResponse(['message'=>'Accident de Travail not found'],Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(AccidentTravailType::class, $accident);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($accident);
            $em->flush();
            return $secteur;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT,serializerGroups={"accident"})
    * @Rest\Delete("/accident/supprimer/{id}")
    */
    public function removeAccidentAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $accident = $em->getRepository('CmiApiBundle:AccidentTravail')
                    ->find($request->get('id'));
    
         /* @var $accident Accident */

        if ($accident) {
            $em->remove($accident);
            $em->flush();
        }
    }


    public function updateAccident(Request $request, $clearMissing)
    {

        $accident = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:AccidentTravail")
                        ->find($request->get('id'));

        $agent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('a_id'));
        $accident->setPatient($agent);

        $equipe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Equipe')
                ->find($request->get('e_id'));
        $accident->setEquipe($equipe);


        $natureLesion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureLesion')
                ->find($request->get('nl_id'));
        $accident->setNatureLesion($natureLesion);


        $agentMateriel = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:AgentMateriel')
                ->find($request->get('am_id'));
        $accident->setAgentMateriel($agentMateriel);


        $secteur = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:secteur')
                ->find($request->get('sec_id'));
        $accident->setSecteur($secteur);


        $natureAccident = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:NatureAccident')
                ->find($request->get('na_id'));
        $accident->setNatureAccident($natureAccident);


        $siegeLesion = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:SiegeLesion')
                ->find($request->get('sl_id'));
        $accident->setSiegeLesion($siegeLesion);


        $activite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Activite')
                ->find($request->get('act_id'));
        $accident->setActivite($activite);


        // $accident->setAtDateEnreg(new \DateTime("now"));
        $accident->setAtDateModif(new \DateTime("now"));

        $form = $this->createForm(AccidentTravailType::class, $accident);

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
    * @Rest\View(serializerGroups={"accident"})
    * @Rest\Put("/agent/{a_id}/equipe/{e_id}/natureLesion/{nl_id}/siegeLesion/{sl_id}/agentMateriel/{am_id}/secteur/{sec_id}/natureAccident/{na_id}/activite/{act_id}/accident/{id}/modifier")
    */
    public function updateAccidentAction(Request $request)
    {
        return $this->updateAccident($request, false);
    }

    /**
    * @Rest\View(serializerGroups={"accident"})
    * @Rest\Patch("/agent/{a_id}/equipe/{e_id}/natureLesion/{nl_id}/siegeLesion/{sl_id}/agentMateriel/{am_id}/secteur/{sec_id}/natureAccident/{na_id}/activite/{act_id}/accident/{id}/modifier")
    */
    public function patchAccidentAction(Request $request)
    {
        return $this->updateAccident($request, false);
    }

}
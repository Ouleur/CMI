<?php 
// src/Cmi/ApiBundle/Controller/EntiteControler.php
namespace Cmi\ApiBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\EntiteType;
use Cmi\ApiBundle\Entity\Entite;


class EntiteController extends FOSRestController
{
    /**
     * @Rest\View()
     * @Rest\Get("/entites/afficher")
     */
    public function getEntitesAction()
    {
    	$entites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->findAll();
        /* @var $places Place[] */
         if (empty($entites)) {
            return new JsonResponse(['message' => 'Entite not found']);
        }
        return $entites;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/entites/{id}")
     */
    public function getEntiteAction( Request $request)
    {
    	$entites = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get('id'));
        /* @var $places Place[] */
        if (empty($entites)) {
            return new JsonResponse(['message' => 'Entite not found']);
        }
        return $entites;
    
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/societe/{s_id}/parent/{p_id}/entites/creer")
     */
    public function postEntitesAction(Request $request)
    {

        $societe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Societe')
                ->find($request->get('s_id'));
        /* @var $places Place[] */

        $parent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get('p_id'));




    	$entite = new Entite();

        $entite->setSociete($societe);
        $entite->setParent($parent);
        // $entite->setEntiteNumero($request->get("numero"));
        // $entite->setEntiteCode($request->get("code"));
        $entite->setEntiDateEnreg(new \DateTime("now"));
        $entite->setEntiDateModif(new \DateTime("now"));
        $form = $this->createForm(EntiteType::class, $entite);
        $form->submit($request->query->all()); // Validation des données
        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($entite);
            $em->flush();
            return $entite;
        }else{
            return $form;
        }
    	
    	
    	
    }
    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/entites/supprimer/{id}")
    */
    public function removeEntitesAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$entite = $em->getRepository('CmiApiBundle:Entite')
    				->find($request->get('id'));
    
    	 /* @var $place Place */
        if ($entite) {
    		$em->remove($entite);
    		$em->flush();
    	}
    }
    
    public function updateEntite(Request $request, $clearMissing)
    {

         $societe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Societe')
                ->find($request->get('s_id'));
        /* @var $places Place[] */

        $parent = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get('p_id'));


        
        $entite->setEntiDateModif(new \DateTime("now"));


        $entite = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Entite")
                        ->find($request->get('id'));

        $entite->setSociete($societe);
        $entite->setParent($parent);
        
        $entite->setEntiDateModif(new \DateTime("now"));
        if (empty($entite)) {
            # code...
            return new JsonResponse(['message'=>'Entite not found'],Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(EntiteType::class, $entite);
        $form->submit($request->query->all(),$clearMissing); // Validation des données
        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($entite);
            $em->flush();
            return $entite;
        }else{
            return $form;
        }
    }
    /**
    * @Rest\View()
    * @Rest\Put("/societe/{s_id}/parent/{p_id}/entites/{id}")
    */
    public function updateEntiteAction(Request $request)
    {
        return $this->updateEntite($request, true);
    }
    /**
    * @Rest\View()
    * @Rest\Patch("/societe/{s_id}/parent/{p_id}/entites/{id}")
    */
    public function patchEntiteAction(Request $request)
    {
        return $this->updateEntite($request, false);
    }
}
<?php 
// src/Cmi/ApiBundle/Controller/ProfessionControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\ProfessionType;
use Cmi\ApiBundle\Entity\Profession;

class ProfessionController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"profession"})
     * @Rest\Get("/professions")
     */
    public function getProfessionsAction()
    {

    	$professions = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Profession')
                ->findAll();
        /* @var $places Place[] */

         if (empty($professions)) {
            return new JsonResponse(['message' => 'Profession not found'], Response::HTTP_NOT_FOUND);
        }

        return $professions;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/professions/{id}")
     */
    public function getProfessionAction( Request $request)
    {

    	$professions = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Profession')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($professions)) {
            return new JsonResponse(['message' => 'Profession not found'], Response::HTTP_NOT_FOUND);
        }

        return $professions;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/professions")
     */
    public function postProfessionsAction(Request $request)
    {

    	$proffession = new Profession();

        // $proffession->setProfessionNumero($request->get("numero"));
        // $proffession->setProfessionCode($request->get("code"));
        $proffession->setProffDateEnreg(new \DateTime("now"));
        $proffession->setProffDateModif(new \DateTime("now"));

        $form = $this->createForm(ProfessionType::class, $proffession);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($proffession);
            $em->flush();
            return $proffession;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/professions/{id}")
    */
    public function removeProfessionsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$proffession = $em->getRepository('CmiApiBundle:Profession')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($proffession) {
    		$em->remove($proffession);
    		$em->flush();
    	}

    }



    
    public function updateProfession(Request $request, $clearMissing)
    {
        $proffession = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Profession")
                        ->find($request->get('id'));

        
        $proffession->setProffDateModif(new \DateTime("now"));

        if (empty($proffession)) {
            # code...
            return new JsonResponse(['message'=>'Profession not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ProfessionType::class, $proffession);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($proffession);
            $em->flush();
            return $proffession;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/professions/{id}")
    */
    public function updateProfessionAction(Request $request)
    {
        return $this->updateProfession($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/professions/{id}")
    */
    public function patchProfessionAction(Request $request)
    {
        return $this->updateProfession($request, false);
    }

}
<?php 
// src/Cmi/ApiBundle/Controller/Resultat_examenControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\Resultat_examenType;
use Cmi\ApiBundle\Entity\Resultat_examen;

class Resultat_examenController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/resultat_examens")
     */
    public function getResultat_examensAction()
    {

    	$resultat_examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Resultat_examen')
                ->findAll();
        /* @var $places Place[] */

         if (empty($resultat_examens)) {
            return new JsonResponse(['message' => 'Resultat_examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $resultat_examens;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/resultat_examens/{id}")
     */
    public function getResultat_examenAction( Request $request)
    {

    	$resultat_examens = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Resultat_examen')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($resultat_examens)) {
            return new JsonResponse(['message' => 'Resultat_examen not found'], Response::HTTP_NOT_FOUND);
        }

        return $resultat_examens;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/consultation/{c_id}/examen/{e_id}/resultat_examens/creer")
     */
    public function postResultat_examensAction(Request $request)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('c_id'));

        $examen = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->find($request->get('e_id'));

    	$resultat_examen = new Resultat_examen();

        // $resultat_examen->setResultat_examenNumero($request->get("numero"));
        // $resultat_examen->setResultat_examenCode($request->get("code"));
        $resultat_examen->setConsultation($consultation);
        $resultat_examen->setExamen($examen);
        $resultat_examen->setResDateEnreg(new \DateTime("now"));
        $resultat_examen->setResDateModif(new \DateTime("now"));

        $form = $this->createForm(Resultat_examenType::class, $resultat_examen);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($resultat_examen);
            $em->flush();
            return $resultat_examen;
        }else{
            return $form;
        }
    	

    	


    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/resultat_examens/{id}")
    */
    public function removeResultat_examensAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$resultat_examen = $em->getRepository('CmiApiBundle:Resultat_examen')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($resultat_examen) {
    		$em->remove($resultat_examen);
    		$em->flush();
    	}

    }



    
    public function updateResultat_examen(Request $request, $clearMissing)
    {

        $consultation = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Consultation')
                ->find($request->get('c_id'));

        $examen = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Examen')
                ->find($request->get('e_id'));


        $resultat_examen = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Resultat_examen")
                        ->find($request->get('id'));

        $resultat_examen->setConsultation($consultation);
        $resultat_examen->setExamen($examen);

        $resultat_examen->setResDateModif(new \DateTime("now"));

        if (empty($resultat_examen)) {
            # code...
            return new JsonResponse(['message'=>'Resultat_examen not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(Resultat_examenType::class, $resultat_examen);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($resultat_examen);
            $em->flush();
            return $resultat_examen;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/consultation/{c_id}/examen/{e_id}/resultat_examens/{id}")
    */
    public function updateResultat_examenAction(Request $request)
    {
        return $this->updateResultat_examen($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/consultation/{c_id}/examen/{e_id}/resultat_examens/{id}")
    */
    public function patchResultat_examenAction(Request $request)
    {
        return $this->updateResultat_examen($request, false);
    }

}
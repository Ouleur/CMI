<?php 
// src/Cmi/ApiBundle/Controller/PatientControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\PatientType;
use Cmi\ApiBundle\Entity\Patient;

class PatientController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"patient"})
     * @Rest\Get("/patients")
     */
    public function getPatientsAction()
    {

    	$patients = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->findAll();
        /* @var $places Place[] */
     

         if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    }


     /**
     * @Rest\View(serializerGroups={"patient"})
     * @Rest\Get("/patientsSearchMtle")
     */
    public function getPatientsSearchAction(Request $request)
    {
        # code...
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $patients = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Patient')
        ->createQueryBuilder('c')
        ->where($qb->expr()->like("c.patMatricule",$qb->expr()->literal('%' . $request->get('phrase') . '%')))
        // ->setParameters(array("mtr"=>$request->get('phrase')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();

         if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    }

     /**
     * @Rest\View(serializerGroups={"patient"})
     * @Rest\Get("/patientsSearchNom")
     */
    public function getPatientsSearchNomAction(Request $request)
    {

    
            # code...
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $patients = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Patient')
        ->createQueryBuilder('c')
        ->where($qb->expr()->like("c.patNom",$qb->expr()->literal('%' . $request->get('phrase') . '%')))
        // ->setParameters(array("mtr"=>$request->get('phrase')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();

         if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    }

    /**
     * @Rest\View(serializerGroups={"patient"})
     * @Rest\Get("/patients/typePatient/{typ_id}")
     */
    public function getPatientsSearchTypeAction(Request $request)
    {
    // $patients = $this->get('doctrine.orm.entity_manager')
        //         ->getRepository('CmiApiBundle:Patient')
        //         ->find($request->get('id'));

        $patients = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Patient')
    ->createQueryBuilder('p')
    ->where("p.type_patient=:type_id")
    ->setParameters(array("type_id"=>$request->get('typ_id')))
    // // ->sort('price', 'ASC')
    // ->limit(10)
    ->getQuery()
    ->execute();
        /* @var $places Place[] */

        if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/patients/{id}")
     */
    public function getPatientAction( Request $request)
    {

    	$patients = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    
    }


    /**
     * @Rest\View(serializerGroups={"patient"})
     * @Rest\Get("/patients/matricule/{mat}")
     */
    public function getPatientByMatriculeAction( Request $request)
    {

        // $patients = $this->get('doctrine.orm.entity_manager')
        //         ->getRepository('CmiApiBundle:Patient')
        //         ->find($request->get('id'));

        $patients = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Patient')
    ->createQueryBuilder('p')
    ->where("p.patMatricule=:usuario_id")
    ->setParameters(array("usuario_id"=>$request->get('mat')))
    // // ->sort('price', 'ASC')
    // ->limit(10)
    ->getQuery()
    ->execute();
        /* @var $places Place[] */

        if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        return $patients;
    
    }


    /**
     * @Rest\View(serializerGroups={"patient"})
     * @Rest\Get("/patient/selection")
     */
    public function getPatientsSelectAction()
    {
        $patients = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Patient')
                ->findAll();
        /* @var $patients Motif[] */

         if (empty($patients)) {
            return new JsonResponse(['message' => 'Patient not found'], Response::HTTP_NOT_FOUND);
        }

        for ($i=0; $i < count($patients); $i++) { 
            # code...
            $json[] = ['id'=>$patients[$i]->getId(), 'text'=>$patients[$i]->getPatNom()." ".$patients[$i]->getPatPrenoms()];

        }

        return new JsonResponse($json);
    }

    /**
     * @Rest\View(serializerGroups={"patient"},statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/entite/{e_id}/lieutravail/{l_id}/profession/{p_id}/typecontrat/{tp_id}/categorie/{c_id}/type_patient/{typ_id}/patient/creer")
     */
    public function postPatientsAction(Request $request)
    {

        $entite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get('e_id'));

        $lieu_travail = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Lieu_travail')
                ->find($request->get('l_id'));

        $type_contrat = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_contrat')
                ->find($request->get('tp_id'));

        $categorie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Categorie')
                ->find($request->get('c_id'));

        $profession = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Profession')
                ->find($request->get('p_id'));

        $type_patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_patient')
                ->find($request->get('typ_id'));



    	$patient = new Patient();
        $patient->setEntite($entite);
        //lieu_travail
        $patient->setLieuTravail($lieu_travail);
        //type_contrat
        $patient->setTypeContrat($type_contrat);
        //categorie
        $patient->setCategorie($categorie);
        //profession
        $patient->setProfession($profession);
        //type_parent
        $patient->setTypePatient($type_patient);


        // $patient->setPatientNumero($request->get("numero"));
        // $patient->setPatientCode($request->get("code"));
        $patient->setPatDateEnreg(new \DateTime("now"));
        $patient->setPatDateModif(new \DateTime("now"));

        $form = $this->createForm(PatientType::class, $patient);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($patient);
            $em->flush();
            return $patient;
        }else{
            return $form;
        }    	
    }


    /**
     * @Rest\View(serializerGroups={"patient"},statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/type_patient/{typ_id}/patient/creer")
     */
    public function postPatientsAutreAction(Request $request)
    {

        /*$entite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get('e_id'));

        $lieu_travail = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Lieu_travail')
                ->find($request->get('l_id'));

        $type_contrat = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_contrat')
                ->find($request->get('tp_id'));

        $categorie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Categorie')
                ->find($request->get('c_id'));

        $profession = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Profession')
                ->find($request->get('p_id'));

        */
        $type_patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_patient')
                ->find($request->get('typ_id'));



        $patient = new Patient();
        /*$patient->setEntite($entite);
        //lieu_travail
        $patient->setLieuTravail($lieu_travail);
        //type_contrat
        $patient->setTypeContrat($type_contrat);
        //categorie
        $patient->setCategorie($categorie);
        //profession
        $patient->setProfession($profession);
        //type_parent
        */
        $patient->setTypePatient($type_patient);


        // $patient->setPatientNumero($request->get("numero"));
        // $patient->setPatientCode($request->get("code"));
        $patient->setPatDateEnreg(new \DateTime("now"));
        $patient->setPatDateModif(new \DateTime("now"));

        $form = $this->createForm(PatientType::class, $patient);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($patient);
            $em->flush();
            return $patient;
        }else{
            return $form;
        }        
    }


    /**
    * @Rest\View(serializerGroups={"patient"},serializerGroups={"patient"},statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/patients/{id}")
    */
    public function removePatientsAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$patient = $em->getRepository('CmiApiBundle:Patient')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($patient) {
    		$em->remove($patient);
    		$em->flush();
    	}

    }



    
    public function updatePatient(Request $request, $clearMissing)
    {
        $patient = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Patient")
                        ->find($request->get('id'));

        $entite = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Entite')
                ->find($request->get('e_id'));

        $lieu_travail = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Lieu_travail')
                ->find($request->get('l_id'));

        $type_contrat = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_contrat')
                ->find($request->get('tp_id'));

        $categorie = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Categorie')
                ->find($request->get('c_id'));

        $profession = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Proffession')
                ->find($request->get('e_id'));

        $type_patient = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Type_patient')
                ->find($request->get('typ_id'));


        $patient->setEntite($entite);
        //lieu_travail
        $patient->setLieuTravail($lieu_travail);
        //type_contrat
        $patient->setTypeContrat($type_contrat);
        //categorie
        $patient->setCategorie($categorie);
        //profession
        $patient->setProfession($profession);
        //type_parent
        $patient->setTypePatient($type_patient);

        
        $patient->setPatDateModif(new \DateTime("now"));

        if (empty($patient)) {
            # code...
            return new JsonResponse(['message'=>'Patient not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PatientType::class, $patient);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($patient);
            $em->flush();
            return $patient;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View(serializerGroups={"patient"},)
    * @Rest\Put("/entite/{e_id}/lieutravail/{l_id}/profession/{p_id}/typecontrat/{tp_id}/categorie/{c_id}/type_patient/{typ_id}/patient/modifier/{id}")
    */
    public function updatePatientsAction(Request $request)
    {
        return $this->updatePatient($request, true);
    }


    /**
    * @Rest\View(serializerGroups={"patient"},)
    * @Rest\Patch("/entite/{e_id}/lieutravail/{l_id}/profession/{p_id}/typecontrat/{tp_id}/categorie/{c_id}/type_patient/{typ_id}/patient/modifier/{id}")
    */
    public function patchPatientsAction(Request $request)
    {
        return $this->updatePatient($request, false);
    }

}
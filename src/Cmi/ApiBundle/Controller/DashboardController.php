<?php 
// src/Cmi/ApiBundle/Controller/DashboardController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Entity\AccidentTravail;
use Cmi\ApiBundle\Entity\Consultation;
use Symfony\Component\Validator\Constraints\Date;

class DashboardController extends FOSRestController
{
	/**
     * @Rest\View(serializerGroups={"consultation"})
     * @Rest\Get("/consultationsJourNombre")
     */
    public function getConsultationJourNombreAction( Request $request)
    {
        $consultation = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Consultation')
        ->createQueryBuilder('c')
        ->where("c.cons_date=:date")
        ->setParameters(array("date"=>Date('Y-m-d')))
        // // ->sort('price', 'ASC')
        // ->limit(10)
        ->getQuery()
        ->execute();

        $consultationTotal = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:Consultation')->findAll();


        $accident = $this->get('doctrine.orm.entity_manager')->getRepository('CmiApiBundle:AccidentTravail')->findAll();
        // ->createQueryBuilder('c')
        // ->where("c.atDateEnreg=:date")
        // ->setParameters(array("date"=>Date('Y-m-d')))
        // // // ->sort('price', 'ASC')
        // // ->limit(10)
        // ->getQuery()
        // ->execute();

        /* @var $consultation Consultation[] */
        $data = array();
        if (empty($consultation)) {
            $data['consultation']=0;
        }else {
            $data['consultation']=count($consultation);
        	
        }

        if (empty($consultation)) {
            $data['consultationTotal']=0;
        }else {
            $data['consultationTotal']=count($consultationTotal);
        	
        }

        if (empty($consultation)) {
            $data['accident']=0;
        }else {
            $data['accident']=count($accident);
        	
        }

              

        return $data;
    }


    /**
     * @Rest\View(serializerGroups={"consultation"})
     * @Rest\Get("/consultationsParDep")
     */
    public function getConsultationParDepAction( Request $request)
    {

    	$query = 'SELECT femme.id,femme.enti_libelle,(homme.qte_patientM+femme.qte_patientF) as Total,femme.qte_patientF,homme.qte_patientM FROM (SELECT en.id, en.enti_libelle, COUNT(cf.id) AS qte_patientF FROM entite AS en LEFT JOIN (select pa.id,pa.pat_sexe,pa.entite_id FROM consultation as cn,patient as pa WHERE pa.id=cn.patient_id and pa.pat_sexe="F") as cf on (cf.entite_id = en.id and cf.pat_sexe="F") GROUP BY en.id ORDER BY en.enti_libelle DESC) as femme LEFT JOIN (SELECT en.id, en.enti_libelle, COUNT(cf.id) AS qte_patientM FROM entite AS en LEFT JOIN (select pa.id,pa.pat_sexe,pa.entite_id FROM consultation as cn,patient as pa WHERE pa.id=cn.patient_id and pa.pat_sexe="M") as cf on (cf.entite_id = en.id and cf.pat_sexe="M") GROUP BY en.id ORDER BY en.enti_libelle DESC) as homme ON femme.id=homme.id ';
		$em = $this->getDoctrine()->getManager();

        $connection = $em->getConnection();
        $statement = $connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll();

                  
        return $data;
    }


    /**
     * @Rest\View(serializerGroups={"consultation"})
     * @Rest\Get("/accidentParDep")
     */
    public function getAccidentParDepAction( Request $request)
    {

    	$query = 'SELECT femme.id,femme.enti_libelle,(homme.qte_patientM+femme.qte_patientF) as Total,femme.qte_patientF,homme.qte_patientM FROM (SELECT en.id, en.enti_libelle, COUNT(atf.id) AS qte_patientF FROM entite AS en LEFT JOIN (select pa.id,pa.pat_sexe,pa.entite_id FROM accident_travail as at,patient as pa WHERE pa.id=at.patient_id and pa.pat_sexe="F") as atf on (atf.entite_id = en.id and atf.pat_sexe="F") GROUP BY en.id ORDER BY en.enti_libelle DESC) as femme LEFT JOIN (SELECT en.id, en.enti_libelle, COUNT(atf.id) AS qte_patientM FROM entite AS en LEFT JOIN (select pa.id,pa.pat_sexe,pa.entite_id FROM accident_travail as at,patient as pa WHERE pa.id=at.patient_id and pa.pat_sexe="M") as atf on (atf.entite_id = en.id and atf.pat_sexe="M") GROUP BY en.id ORDER BY en.enti_libelle DESC) as homme ON femme.id=homme.id ';
		$em = $this->getDoctrine()->getManager();

        $connection = $em->getConnection();
        $statement = $connection->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll();

                  
        return $data;
    }
}
<?php 
// src/Cmi/ApiBundle/Controller/CertificatMedicalController.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CertificatMedicalType;
use Cmi\ApiBundle\Entity\CertificatMedical;

class CertificatMedicalController extends FOSRestController
{

    /**
     * @Rest\View()
     * @Rest\Get("/certificatmedicals/afficher")
     */
    public function getCertificatMedicalsAction()
    {
        $certificatmedicals = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:CertificatMedical')
                ->findAll();
        /* @var $certificatmedicals CertificatMedical[] */

         if (empty($certificatmedicals)) {
            return new JsonResponse(['message' => 'CertificatMedicals not found'], Response::HTTP_NOT_FOUND);
        }

        return $certificatmedicals;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/certificatmedicals/rechercher/{id}")
     */
    public function getCertificatMedicalAction( Request $request)
    {
        $certificatmedical = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:CertificatMedical')
                ->find($request->get('id'));
        /* @var $certificatmedical CertificatMedical[] */

        if (empty($certificatmedical)) {
            return new JsonResponse(['message' => 'CertificatMedical not found'], Response::HTTP_NOT_FOUND);
        }

        return $certificatmedical;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/certificatmedicals/creer")
     */
    public function postCertificatMedicalAction(Request $request)
    {

        $certificatmedical = new CertificatMedical();


        $certificatmedical->setCmDateEnreg(new \DateTime("now"));
        $certificatmedical->setCmDateModif(new \DateTime("now"));

        $form = $this->createForm(CertificatMedicalType::class, $certificatmedical);

        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($certificatmedical);
            $em->flush();
            return $certificatmedical;
        }else{
            return $form;
        }
        

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/certificatmedicals/supprimer/{id}")
    */
    public function removeCertificatMedicalAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $certificatmedical = $em->getRepository('CmiApiBundle:CertificatMedical')
                    ->find($request->get('id'));
    
         /* @var $certificatmedical CertificatMedical */

        if ($certificatmedical) {
            $em->remove($certificatmedical);
            $em->flush();
        }
    }


    public function updateCertificatMedical(Request $request, $clearMissing)
    {

        $certificatmedical = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:CertificatMedical")
                        ->find($request->get('id'));

        
        $certificatmedical->setCmDateModif(new \DateTime("now"));

        if (empty($certificatmedical)) {
            # code...
            return new JsonResponse(['message'=>'CertificatMedical not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(CertificatMedicalType::class, $certificatmedical);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($certificatmedical);
            $em->flush();
            return $certificatmedical;
        }else{
            return $form;
        }
    }


    /**
    * @Rest\View()
    * @Rest\Put("/certificatmedicals/modifier/{id}")
    */
    public function updateCertificatMedicalAction(Request $request)
    {
        return $this->updateCertificatMedical($request, false);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/certificatmedicals/modifier/{id}")
    */
    public function patchCertificatMedicalAction(Request $request)
    {
        return $this->updateCertificatMedical($request, false);
    }
}
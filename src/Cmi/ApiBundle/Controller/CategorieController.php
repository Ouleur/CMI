<?php 
// src/Cmi/ApiBundle/Controller/CategorieControler.php

namespace Cmi\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Form\Type\CategorieType;
use Cmi\ApiBundle\Entity\Categorie;

class CategorieController extends FOSRestController
{

    /**
     * @Rest\View(serializerGroups={"categorie"})
     * @Rest\Get("/categories")
     */
    public function getCategoriesAction()
    {

    	$categories = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Categorie')
                ->findAll();
        /* @var $places Place[] */

         if (empty($categories)) {
            return new JsonResponse(['message' => 'Categorie not found'], Response::HTTP_NOT_FOUND);
        }

        return $categories;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/categories/{id}")
     */
    public function getCategorieAction( Request $request)
    {

    	$categories = $this->get('doctrine.orm.entity_manager')
                ->getRepository('CmiApiBundle:Categorie')
                ->find($request->get('id'));
        /* @var $places Place[] */

        if (empty($categories)) {
            return new JsonResponse(['message' => 'Categorie not found'], Response::HTTP_NOT_FOUND);
        }

        return $categories;
    
    }


    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/categories")
     */
    public function postCategoriesAction(Request $request)
    {

    	$categorie = new Categorie();

        // $categorie->setCategorieNumero($request->get("numero"));
        // $categorie->setCategorieCode($request->get("code"));
        $categorie->setCateDateModif(new \DateTime("now"));
        $categorie->setCateDateEnreg(new \DateTime("now"));

        $form = $this->createForm(CategorieType::class, $categorie);


        $form->submit($request->query->all()); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($categorie);
            $em->flush();
            return $categorie;
        }else{
            return $form;
        }
    	
    }


    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/categories/{id}")
    */
    public function removeCategoriesAction(Request $request)
    {
    	$em = $this->get('doctrine.orm.entity_manager');
    	$categorie = $em->getRepository('CmiApiBundle:Categorie')
    				->find($request->get('id'));
    
    	 /* @var $place Place */

        if ($categorie) {
    		$em->remove($categorie);
    		$em->flush();
    	}

    }



    
    public function updateCategorie(Request $request, $clearMissing)
    {
        $categorie = $this->get("doctrine.orm.entity_manager")
                        ->getRepository("CmiApiBundle:Categorie")
                        ->find($request->get('id'));

        
        $categorie->setCateDateEnreg(new \DateTime("now"));

        if (empty($categorie)) {
            # code...
            return new JsonResponse(['message'=>'Categorie not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(CategorieType::class, $categorie);


        $form->submit($request->query->all(),$clearMissing); // Validation des données

        if ($form->isValid()){
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($categorie);
            $em->flush();
            return $categorie;
        }else{
            return $form;
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/categories/{id}")
    */
    public function updateCategorieAction(Request $request)
    {
        return $this->updateCategorie($request, true);
    }


    /**
    * @Rest\View()
    * @Rest\Patch("/categories/{id}")
    */
    public function patchCategorieAction(Request $request)
    {
        return $this->updateCategorie($request, false);
    }

}
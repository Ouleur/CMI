<?php 
// src/Cmi/ApiBundle/Controller/FileController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Cmi\ApiBundle\Entity\File;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;



class FileController extends FOSRestController
{

	/**
	* @Rest\View(statusCode=Response::HTTP_CREATED)
	* @Rest\Post("/api/uploadDocFile")
	*/
	public function uploadDocAction(Request $request) {
	    try {
	        $file = $request->files->get ( 'my_file' );
	        $fileName = md5 ( uniqid () ) . '.' . $file->guessExtension ();
	        $original_name = $file->getClientOriginalName ();
	        $file->move ( $this->container->getParameter ( 'file_doc_directory' ), $fileName );
	        $file_entity = new File ();
	        $file_entity->setFileName ( $fileName );
	        $file_entity->setActualName ( $original_name );
	        $file_entity->setCreationTime ( new \DateTime () );
	            
	        $manager = $this->getDoctrine ()->getManager ();
	        $manager->persist ( $file_entity );
	        $manager->flush ();
	        $array = array (
	            'status' => 1,
	            'file_id' => $file_entity->getId () 
	        );
	        $response = new JsonResponse ( $array, 200 );
	        return $response;
	    } catch ( Exception $e ) {
	        $array = array('status'=> 0 );
	        $response = new JsonResponse($array, 400);
	        return $response;
	    }
	}

	/**
	* @Rest\View(statusCode=Response::HTTP_CREATED)
	* @Rest\Post("/api/uploadImageFile")
	*/
	public function uploadImageAction(Request $request) {
	    try {
	        $file = $request->files->get ( 'my_file' );
	        $fileName = md5 ( uniqid () ) . '.' . $file->guessExtension ();
	        $original_name = $file->getClientOriginalName ();
	        $file->move ( $this->container->getParameter ( 'file_img_directory' ), $fileName );
	        $file_entity = new File ();
	        $file_entity->setFileName ( $fileName );
	        $file_entity->setActualName ( $original_name );
	        $file_entity->setCreationTime ( new \DateTime () );
	            
	        $manager = $this->getDoctrine ()->getManager ();
	        $manager->persist ( $file_entity );
	        $manager->flush ();
	        $array = array (
	            'status' => 1,
	            'file_id' => $file_entity->getId () ,
	            'path' => $this->container->getParameter ( 'file_img_directory' ) . "/" . $fileName
	        );
	        $response = new JsonResponse ( $array, 200 );
	        return $response;
	    } catch ( Exception $e ) {
	        $array = array('status'=> 0 );
	        $response = new JsonResponse($array, 400);
	        return $response;
	    }
	}

	/**
	 * @Rest\View()
     * @Rest\Get("/api/downloadDocFile/{id}")
     */
	public function downloadDocAction(Request $request) {
	    try {
	        $file = $this->getDoctrine ()->getRepository ( 'CmiApiBundle:File' )->find ( $request->get('id'));
	        if (! $file) {
	            $array = array (
	                'status' => 0,
	                'message' => 'File does not exist' 
	            );
	            $response = new JsonResponse ( $array, 200 );
	            return $response;
	        }
	        $displayName = $file->getActualName ();
	        $fileName = $file->getFileName ();
	        $file_with_path = $this->container->getParameter ( 'file_doc_directory' ) . "/" . $fileName;
	        $response = new BinaryFileResponse ( $file_with_path );
	        $response->headers->set ( 'Content-Type', 'text/plain' );
	        $response->setContentDisposition ( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $displayName );
	        $array = array (
	            'status' => $file_with_path,
	            'file_id' => $response
	        );
	        return new JsonResponse ( $array, 200 );
	    } catch ( Exception $e ) {
	        $array = array (
	            'status' => 0,
	            'message' => 'Download error' 
	        );
	        $response = new JsonResponse ( $array, 400 );
	        return $response;
	    }
	}

	/**
	 * @Rest\View()
     * @Rest\Get("/api/downloadImageFile/{id}")
     */
	public function downloadImageAction(Request $request) {
	    try {
	        $file = $this->getDoctrine ()->getRepository ( 'CmiApiBundle:File' )->find ( $request->get('id'));
	        if (! $file) {
	            $array = array (
	                'status' => 0,
	                'message' => 'File does not exist' 
	            );
	            $response = new JsonResponse ( $array, 200 );
	            return $response;
	        }
	        $displayName = $file->getActualName ();
	        $fileName = $file->getFileName ();
	        $file_with_path = $this->container->getParameter ( 'file_img_directory' ) . "/" . $fileName;
	        $response = new BinaryFileResponse ( $file_with_path );
	        $response->headers->set ( 'Content-Type', 'image/png' );
	        $response->setContentDisposition ( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $displayName );
	        $array = array (
	            'status' => $file_with_path,
	            'file_id' => $response
	        );
	        return $response;
	    } catch ( Exception $e ) {
	        $array = array (
	            'status' => 0,
	            'message' => 'Download error' 
	        );
	        $response = new JsonResponse ( $array, 400 );
	        return $response;
	    }
	}
}
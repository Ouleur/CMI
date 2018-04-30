<?php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class UploadController extends Controller
{
    public function uploadAction(Request $request)
    {
        $form = $this->createForm(new MediaFormType());

        /** @var $uploadHandler UploadHandler */
        $uploadHandler = $this->get('srio_rest_upload.upload_handler');
        $result = $uploadHandler->handleRequest($request, $form);

        if (($response = $result->getResponse()) != null) {
            return $response;
        }

        if (!$form->isValid()) {
            throw new BadRequestHttpException();
        }

        if (($file = $result->getFile()) !== null) {
            /** @var $media Media */
            $media = $form->getData();
            $media->setFile($file);

            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();

            return new JsonResponse($media);
        }

        throw new NotAcceptableHttpException();
    }
}
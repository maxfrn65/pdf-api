<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfController extends AbstractController
{
    #[Route('/html-to-pdf', name: 'app_pdf')]
    public function htmlToPdf(HttpClientInterface $client, ParameterBagInterface $param): Response
    {
        $service_url=$param->get('service_url');

        $file = fopen('index.html', 'r');
        $response = $client->request(
            'POST',
            $service_url.'/forms/chromium/convert/html', [
                'headers' => [
                    'Content-Type' => 'multipart/form-data'
                ],
                'body' => ['files' => $file]
        ]);
        $content = $response->getContent();

        $responsePdf = new Response($content);
        $responsePdf->headers->set('Content-Type', "application/pdf");

        return $responsePdf;
    }
}

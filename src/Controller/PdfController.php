<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfController extends AbstractController
{
    #[Route('/pdf', name: 'app_pdf')]
    public function htmlToPdf(HttpClientInterface $client, ParameterBagInterface $param) {

        $service_url=$param->get('service_url');

        $response = $client->request(
            'POST',
            $url_service.'/forms/chromium/convert/html', [
                'headers' => [
                    'Content-Type' => 'multipart/form-data'
                ],
                'body' => $file
        ]);
    }
}

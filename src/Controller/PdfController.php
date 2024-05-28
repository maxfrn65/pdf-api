<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfController extends AbstractController
{
    #[Route('/html-to-pdf', name: 'app_pdf')]
    public function htmlToPdf(HttpClientInterface $client, ParameterBagInterface $param, $file): void
    {
        $service_url=$param->get('service_url');

        $response = $client->request(
            'POST',
            $service_url.'/forms/chromium/convert/html', [
                'headers' => [
                    'Content-Type' => 'multipart/form-data'
                ],
                'body' => $file
        ]);
        $content = $response->getContent();
        dump($content);
    }
}

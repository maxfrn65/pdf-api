<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PdfFileTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/html-to-pdf');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame("content-type", "application/pdf");
    }
}

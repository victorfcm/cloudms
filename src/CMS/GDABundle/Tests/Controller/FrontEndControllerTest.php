<?php

namespace CMS\GDABundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontEndControllerTest extends WebTestCase
{
    public function testEnquete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/frontend/enquete');
    }

    public function testCaravana()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/frontend/caravana');
    }

    public function testCalendario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/frontend/calendario');
    }

}

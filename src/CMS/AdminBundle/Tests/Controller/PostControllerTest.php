<?php

namespace CMS\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cms/post');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cms/post');
    }

}

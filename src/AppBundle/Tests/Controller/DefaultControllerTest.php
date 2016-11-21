<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to RPSSL', $crawler->filter('h1')->text());
    }

    public function testDuel()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/duel');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to RPSSL:', $crawler->filter('#welcome h1')->text());
    }
}

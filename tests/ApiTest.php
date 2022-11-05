<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Prestation;

class ApiTest extends ApiTestCase
{
    // This trait provided by AliceBundle will take care of refreshing the database content to a known state before each test

    public function testGetCollection(): void
    {
        // Asserts that the response is successfull with GET
        $response = static::createClient()->request('GET', 'http://127.0.0.1:8000/api/prestations');
        $this->assertResponseIsSuccessful();

        // Asserts that the returned content type is JSON
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Check 200 response
        $this->assertEquals(200, $response->getStatusCode());

    }
}
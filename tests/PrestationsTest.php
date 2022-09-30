<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Prestation;

class PrestationsTest extends ApiTestCase
{
    public function testSetPrestation()
    {
        $prestation = new Prestation();
        $value = 'Doe';
        $prestation->setTitre($value);
        $this->assertEquals($value, $prestation->getTitre());
    }
}
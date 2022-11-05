<?php

namespace App\Tests;

use App\Entity\Prestation;
use PHPUnit\Framework\TestCase;


class PrestationsTest extends TestCase
{
    public function testSetPrestation()
    {
        $prestation = new Prestation();
        $value = 'Ma super prestation';
        $prestation->setTitre($value);
        $this->assertEquals($value, $prestation->getTitre());
    }

}
<?php

namespace Fundeuis\FrontalBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BusquedaglobalControllerTest extends WebTestCase
{
    public function testBuscarciudad()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'frontal/busquedaGlobal/buscarCiudad');
    }

    public function testBuscarcolegio()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'frontal/busquedaGlobal/buscarColegio');
    }

    public function testBuscaruniversidad()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'frontal/busquedaGlobal/buscarUniversidad');
    }

}

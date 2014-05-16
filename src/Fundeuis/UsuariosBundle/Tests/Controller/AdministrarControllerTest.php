<?php

namespace Fundeuis\UsuariosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministrarControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/administrador/administrarUsuarios/crear');
    }

    public function testModificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/administrador/administrarUsuarios/modificar');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/administrador/administrarUsuarios/eliminar');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/administrador/administrarUsuarios/');
    }

}

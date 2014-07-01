<?php

namespace Fundeuis\InscripcionpreicfesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MatriculaControllerTest extends WebTestCase
{
    public function testMatricular()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarCursos/matricular/{id}');
    }

}

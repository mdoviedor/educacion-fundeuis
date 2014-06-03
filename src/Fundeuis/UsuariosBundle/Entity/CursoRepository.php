<?php

namespace Fundeuis\UsuariosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CursoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CursoRepository extends EntityRepository {

    public function buscarCursosAñoActual() {
        $year = \date('Y');

        return $this->getEntityManager()
                        ->createQuery('SELECT c FROM FundeuisUsuariosBundle:Curso c WHERE c.fechainicio LIKE :fecha  ORDER BY c.fechainicio DESC')                      
                        ->setParameter('fecha', '%' . $year . '%')
                        ->getResult();
    }

}

<?php

namespace Grdf\GaiaBundle\Repository;

use Grdf\DefaultBundle\Repository\CarmaEntityRepository;

class UserRepository extends CarmaEntityRepository
{

    public function findAllOrderedByTitle()
    {
        $qb = $this->createQueryBuilder('u');
        $qb
            ->orderBy('u.gaia', 'ASC');
        $query = $qb->getQuery();
        //Retour
        return $query->getResult();
    }

    public function getEmailsWhoReceiveEmails()
    {
        $qb = $this->createQueryBuilder('u');
        $qb
            ->select('u.email')
            ->where($qb->expr()->isNotNull('u.email'))
            ->andWhere($qb->expr()->eq('u.receiveEmails', ':receiveEmails'))
            ->orderBy('u.gaia', 'ASC')
            ->setParameter(':receiveEmails', true);
        $query = $qb->getQuery();
        $result = $query->getScalarResult();
        $ret = array();
        foreach ($result as $res) {
            $ret[] = $res['email'];
        }
        //Retour
        return $ret;
    }

}

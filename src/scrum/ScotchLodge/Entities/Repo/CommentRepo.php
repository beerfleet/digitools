<?php

namespace scrum\ScotchLodge\Entities\Repo;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * CountryRepo repository
 *
 * @author jan van biervliet
 */
class CommentRepo extends EntityRepository {

  public function getRecentComments($limit = null) {
    $qb = $this->getEntityManager()->createQueryBuilder();

    if ($limit == null) {
      $qb->select('c')
          ->from('scrum\ScotchLodge\Entities\Comment', 'c')
          ->orderBy('c.comment_date', 'DESC');
    }
    else {
      $qb->select('c')
          ->from('scrum\ScotchLodge\Entities\Comment', 'c')
          ->orderBy('c.comment_date', 'DESC')
          ->setMaxResults($limit);
    }

    $query = $qb->getQuery();
    $result = $query->execute();
    return $result;
  }

  public function getPopularComments($limit = null) {
    $qb = $this->getEntityManager()->createQueryBuilder();

    if ($limit == null) {
      $qb->select('c as comment, count(c.user) as likes')
          ->from('scrum\ScotchLodge\Entities\CommentLike', 'c')
          ->orderBy('likes', 'DESC')
          ->groupBy('c.comment');
    }
    else {
      $qb->select('c as comment, count(c.user) as likes')
          ->from('scrum\ScotchLodge\Entities\CommentLike', 'c')
          ->groupBy('c.comment')
          ->orderBy('likes', 'DESC')
          ->setMaxResults($limit);
    }
    $query = $qb->getQuery();
    $result = $query->execute();
    return $result;
  }

}

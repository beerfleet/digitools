<?php

namespace scrum\ScotchLodge\Entities\Repo;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepo
 *
 * @author jan van biervliet
 */
class UserRepo extends EntityRepository {
  
  public function clearTokens() {
    $sql = "UPDATE whisky_user SET password_token = null";
    $statement = $this->getEntityManager()
        ->getConnection()
        ->prepare($sql);
    $statement->execute();
  }
  
  
}

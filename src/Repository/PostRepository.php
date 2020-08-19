<?php
/**
 * By: Julie
 */

namespace App\Repository;

use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class PostRepository extends DocumentRepository
{
    public function getPostTitle($title) {
        return $this->createQueryBuilder()
            ->find()
            ->field('title')->equals($title)
            ->getQuery()
            ->execute();
    }
}

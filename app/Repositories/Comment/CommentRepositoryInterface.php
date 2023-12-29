<?php

namespace App\Repositories\Comment;

/**
* Interface CommentRepositoryInterface
* @package App\Repositories
*/
interface CommentRepositoryInterface
{
   
    public function store(array $data);

}
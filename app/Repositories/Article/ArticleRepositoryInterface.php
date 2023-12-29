<?php

namespace App\Repositories\Article;

/**
* Interface ArticleRepositoryInterface
* @package App\Repositories
*/
interface ArticleRepositoryInterface
{
    public function all();

    public function show($id);

    public function store(array $data);

    public function update($id, array $data);

    public function approve($id);

    public function delete($id);
}
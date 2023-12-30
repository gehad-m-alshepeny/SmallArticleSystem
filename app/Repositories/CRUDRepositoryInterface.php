<?php

namespace App\Repositories;
/**
* Interface CRUDRepositoryInterface
* @package App\Repositories
*/
interface CRUDRepositoryInterface
{
    public function all();

    public function show($id);

    public function store(array $data);

    public function update(array $data , $model);

    public function delete($id);
}
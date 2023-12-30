<?php

namespace App\Repositories\Comment;

use App\Repositories\CRUDRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CRUDRepositoryInterface
{
 
    public function all(){}

    public function show($id){}

    public function store(array $data)
    {
        $data['created_by'] = auth()->user()->id;

        return Comment::create($data);
    }

    public function update(array $data, $model){}

    public function delete($id){}

    
}
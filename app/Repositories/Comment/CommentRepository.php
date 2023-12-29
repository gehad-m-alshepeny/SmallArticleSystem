<?php

namespace App\Repositories\Comment;

use App\Repositories\Comment\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
 

    public function store(array $data)
    {
        $data['created_by'] = auth()->user()->id;
        
        return Comment::create($data);
    }

    
}
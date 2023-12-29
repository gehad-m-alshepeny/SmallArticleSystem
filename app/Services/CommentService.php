<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use InvalidArgumentException;

class CommentService
{
    use AuthorizesRequests;
    /**
     * @var $commentRepository
     */
    protected $articleRepository;

    /**
     * CommentService constructor.
     *
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
    * Store comment.
    *
    * @return String
    */
    public function store(array $data)
    {
        $this->authorize('create', Comment::class);
        
        return $this->commentRepository->store($data);
    }

  

}
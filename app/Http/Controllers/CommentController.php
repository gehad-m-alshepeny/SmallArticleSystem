<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
     /**
     * @var commentService
     */
    protected $commentService;

    /**
     * CommentController Constructor
     *
     * @param CommentService $commentService
     *
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
  
    public function store(CommentRequest $request)
    {
        $data =  $request->only(['article_id', 'content']);

        $this->commentService->store($data);
        
        return back();
    }
}
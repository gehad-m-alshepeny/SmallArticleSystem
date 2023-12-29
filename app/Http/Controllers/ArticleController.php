<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * @var articleService
     */
    protected $articleService;

    /**
     * ArticleController Constructor
     *
     * @param ArticleService $articleService
     *
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(): View
    { 
        $articles = $this->articleService->all();
        
        return view('article.index',compact('articles'));
    }

    public function create(): View
    {
        $this->authorize('create', Article::class);

        return view('article.create');
    }
 
    public function store(ArticleRequest $request) :RedirectResponse
    {
        $data =  $request->only(['title', 'content']);

        $articles = $this->articleService->store($data);
        
        return redirect()->route('articles.index')
                         ->with('success','Article created successfully.');
    }

    public function show($id): View
    {
        $article = $this->articleService->show($id);

        return view('article.show',compact('article'));
    }

    public function edit(Article $article): View
    {
        $this->authorize('update', $article);

        return view('article.edit',compact('article'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data =  $request->only(['title', 'content']);

        $articles = $this->articleService->update($article->id, $data);

        return redirect()->route('articles.index')
                        ->with('success','Article updated successfully');
    }

    public function approve()
    {
        if (! auth()->user()->role_id == ADMIN) {
            abort(403);
        }
        $this->articleService->approve(request()->only(['article_id']));

        return redirect()->route('articles.index')
                         ->with('success','Article approved successfully.');

    }
    public function destroy(Article $article): RedirectResponse
    {
         $this->articleService->delete($article->id);

        return redirect()->route('articles.index')
                        ->with('success','Article deleted successfully');
    }
}
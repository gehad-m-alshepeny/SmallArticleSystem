<?php

namespace App\Repositories\Article;

use App\Repositories\CRUDRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ArticleRepository implements CRUDRepositoryInterface
{
    public function all()
    {  
        if(request()->has('titlesearch')){
            $articles = Article::search(request()->titlesearch)->paginate(10); 
        } else {
            $articles = Cache::rememberForever('articles_'. request('page', 1), function () {
                return Article::with('comments')->approved()->latest()->paginate(10); 
            });
        }
 
        return $articles;             
    }

    public function show($id)
    {
        return Article::findOrFail($id);
    }

    public function store(array $data)
    {
        $data['created_by'] = auth()->user()->id;

        return Article::create($data);
    }

    public function update(array $data, $article)
    {
        return $article->update($data); 
    }

    public function delete($article)
    {
        return $article->delete();
    }

    public function approve($id)
    {
        return Article::whereId($id)->update([
            'status'=>'approved',
            'approved_by'=> auth()->user()->id,
            'approved_at'=> now()
            ]);
    }
   

    
}
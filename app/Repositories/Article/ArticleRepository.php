<?php

namespace App\Repositories\Article;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function all()
    {
        if(request()->has('titlesearch')){
            $articles = Article::search(request()->titlesearch)->get(); 
        }else{
            $articles =  Article::with('comments')->approved()->latest()->get(); 
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

    public function update($id, array $data)
    {
        return Article::whereId($id)->update($data);
    }

    public function approve($id)
    {
        return Article::whereId($id)->update([
            'status'=>'approved',
            'approved_by'=> auth()->user()->id,
            'approved_at'=> now()
            ]);
    }

    public function delete($id)
    {
        return Article::find($id)->delete();
    }
   

    
}
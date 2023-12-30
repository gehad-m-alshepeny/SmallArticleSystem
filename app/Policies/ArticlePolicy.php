<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view article details.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can create article.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine if the given article can be updated by the user.
     */
    public function update(?User $user, Article $article): bool
    {
        if(Auth::user()->role_id == ADMIN)
        return true;

        return $user->id === $article->created_by;
    }

      /**
     * Determine whether the user can approve articale.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function approve(?User $user)
    {
        return Auth::user()->role_id == ADMIN;
    }

      /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user,Article $article)
    {
        if(Auth::user()->role_id == ADMIN)
        return true;

        return $user->id === $article->created_by;
    }

    
}

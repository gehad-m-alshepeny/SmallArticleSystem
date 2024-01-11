<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;



class Article extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'status',
        'created_by',
        'approved_by',
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function searchableAs()
    {
        return 'article_index';
    }
    protected function makeAllSearchableUsing(Builder $query): Builder
    {
       return $query->with('comments')->approved();
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }

     /***********************
     * Relationships
     **********************/
    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

     /***********************
     * Scopes
     **********************/
    public function scopeApproved($query)
    {
       if(auth()->check() && auth()->user()->role_id != ADMIN) 
         return $query->where('status','approved')->orWhere('created_by',auth()->user()->id);
    }

}

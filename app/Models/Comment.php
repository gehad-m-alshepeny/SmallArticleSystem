<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_id',
        'content',
        'created_by',
    ];

      /***********************
     * Relationships
     **********************/
    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function article() : BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

}

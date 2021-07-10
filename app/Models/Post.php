<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'title',
        'body',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
    //Try to do scope but not working :((
    //In artisan Tinker giveme an error, to investigate later
    public function scopeBestActivityLastWeek(Builder $query) : Builder
    {
        return $query->whereDate('created_at', '>', Carbon::now()->addDays(-7));
    }
}

<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    use Notifiable;


    protected $fillable = [
        'author_id', 'title', 'body',
    ];
}

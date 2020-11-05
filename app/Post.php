<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table =  'posts';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timeStamps = true;

    // creating a relation. A post has a relation with a user and belongs to a user.
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

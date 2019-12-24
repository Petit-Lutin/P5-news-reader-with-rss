<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name', 'user_id'];
        public function flows()
        {
            return $this->hasMany(Flow::class); // une catégorie peut contenir plusieurs flux
        }
}

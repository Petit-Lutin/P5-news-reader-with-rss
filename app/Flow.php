<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $fillable=['name', 'url', 'category_id'];
        public function category()
        {
            return $this->belongsTo(Category::class); //un flux n'appartient qu'à une catégorie
        }
}

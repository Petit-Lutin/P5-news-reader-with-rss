<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        public function flows()
        {
            return $this->hasMany(Flow::class); // une catégorie peut contenir plusieurs flux
        }
}

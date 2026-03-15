<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
     protected $table = 'programs';
    protected $fillable = [ 'code','name'];
   protected $hidden =  ['created_at', 'updated_at'];

      public function enrollments()
      {
         return $this->hasMany(Enrollments::class, 'program_id', 'code');
      }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students';
    protected $fillable = [
                         'fname',
                          'lname',
                          'middle_name',
                          'sname',
                          'gender',
                          'bdate',
                          'email',
    ];
   protected $hidden =  ['created_at', 'updated_at'];
    
   public function enrollments()
   {
       return $this->hasMany(Enrollments::class, 'student_id', 'id');
   }
}

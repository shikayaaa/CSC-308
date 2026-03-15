<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
     protected $table = 'enrollments';
    protected $fillable = ['student_id',
                           'subject_id',
                           'subject_schedule_id',
                           'school_year',
                           'semester',];
    protected $hidden =  ['created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo(Programs::class, 'program_id', 'code');
    }
}

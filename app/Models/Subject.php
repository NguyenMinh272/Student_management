<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $fillable = ['id', 'name'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject')->withPivot('mark');
    }

    public function studentSubjects() {
        return $this->hasMany(StudentSubject::class, 'subject_id', 'id');
    }
}


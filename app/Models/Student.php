<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'students';
    protected $dates = ['birthday'];
    protected $fillable = [
        'full_name',
        'address',
        'email',
        'slug',
        'birthday',
        'gender',
        'phone',
        'phone_telecom',
        'image',
        'faculty_id',
        'password'
    ];

    public static $upload_dir = 'images';

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

//    public function studentSubject()
//    {
//        return $this->belongsTo(StudentSubject::class);
//    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject')->withPivot('mark');
    }


}

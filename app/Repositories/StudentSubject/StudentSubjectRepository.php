<?php

namespace App\Repositories\StudentSubject;

use App\Models\StudentSubject;
use App\Models\Subject;
use App\Repositories\BaseRepository;
use App\Repositories\StudentSubject\StudentSubjectRepositoryInterface;

class StudentSubjectRepository extends BaseRepository implements StudentSubjectRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\StudentSubject::class;
    }

    public function updateMark($attributes = [])
    {
        return $attributes;
    }

    public function __construct(StudentSubject $studentsubject)
    {
        parent::__construct($studentsubject);
    }

    public function query(){

        return $this->model->query();
    }

    public function StudentSubject()
    {
        return $this->model->select()->paginate(5);
    }
}

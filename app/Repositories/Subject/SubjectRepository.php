<?php
namespace App\Repositories\Subject;

use App\Models\Subject;
use App\Repositories\BaseRepository;
use App\Repositories\Subject\SubjectRepositoryInterface;


class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function getSubject()
    {
//        $subject = $this->model->query();
//        $subject->whereHas('studentSubjects', function ($q){
//            $q->where('mark','>=', 0);
//        });
        return $this->model->paginate(5);
    }

}

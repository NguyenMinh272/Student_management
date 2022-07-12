<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function search($request, $subjectTotal)
    {
        $student = $this->model->query();
        if (!empty($request['age_from'])) {
            $student->where('birthday', '<=', Carbon::now()->subYear($request['age_from']))->get();
        }

        if (!empty($request['age_to'])) {
            $student->where('birthday', '>=', Carbon::now()->subYear($request['age_to']));
        }

        if (!empty($request['mark_from'])) {
            $mark_from = $request['mark_from'];
            $student->whereHas('subjects', function ($q) use ($mark_from) {
                $q->where('mark', '>', 0);
                $q->where('mark', '>=', $mark_from);
            });
        }

        if (!empty($request['mark_to'])) {
            $mark_to = $request['mark_to'];
            $student->whereHas('subjects', function ($q) use ($mark_to) {
                $q->where('mark', '>', 0);
                $q->where('mark', '<=', $mark_to);
            });

        }

        if (!empty($request['option'])) {
            $operator = '>=';

            if ($request['option'] == "2") {
                $operator = '<';
            }

            $student->whereHas('subjects', function ($q) {
                $q->where('mark', '>', 0);
            }, $operator, $subjectTotal);
        }

        $phones = [
            'viettel' => '^098|^092',
            'vina' => '^083|^082',
            'mobi' => '^070|^079',
        ];

        if (!empty($request['viettel']) || !empty($request['vina']) || !empty($request['mobi'])) {
            $student->where(function ($query) use ($request, $phones) {
                foreach ($phones as $field => $phone) {
                    if (!empty($request[$field])) {
                        $query->orWhere('phone', 'regexp', $phone);
                    }
                }
            });
        }
        $per_size = 15;
        if (isset($request['per_size'])) {
            switch ($request['per_size']) {
                case 1:
                    $per_size = 10;
                    break;
                case 2:
                    $per_size = 100;
                    break;
                case 3:
                    $per_size = 300;
                    break;
            }
        }
        $data = $student->paginate($per_size);
        return $data;
    }

    public function getStudent()
    {
        $student = Student::select('id', 'email', 'full_name')->withAvg('studentSubject', 'mark')
            ->groupBy('students.id', 'email', 'full_name')
            ->having('student_subject_avg_mark', '<', 5);
        return $student->paginate(5);
    }


}

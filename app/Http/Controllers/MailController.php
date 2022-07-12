<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Http\Request;

class MailController extends Controller
{
    protected $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }


    public function sendMail()
    {
        $students = $this->studentRepo->getStudent();
        foreach ($students as $item) {
            SendMailJob::dispatch($item->toArray());
        }

    }
}

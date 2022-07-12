<?php
namespace App\Repositories\Student;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function search($request, $subjectTotal);
    public function getStudent();

}


<?php
namespace App\Repositories\StudentSubject;

use App\Repositories\RepositoryInterface;

interface StudentSubjectRepositoryInterface extends RepositoryInterface
{
    public function StudentSubject();
    public function updateMark();
    public function query();
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarkRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\User;
use App\Models\Subject;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\StudentSubject\StudentSubjectRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Classes\StudentService;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $studentRepo;
    protected $facultyRepo;
    protected $subjectRepo;

    public function __construct(
        StudentRepositoryInterface $studentRepo,
        FacultyRepositoryInterface $facultyRepo,
        SubjectRepositoryInterface $subjectRepo,
        StudentSubjectRepositoryInterface $resultRepo,
    ) {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
        $this->subjectRepo = $subjectRepo;
        $this->resultRepo = $resultRepo;
    }

    public function index(Request $request)
    {
        $faculties = $this->facultyRepo->getFaculty()->pluck('name', 'id');
        $students = $this->studentRepo->search($request->all(), Subject::count('id'));

        return view('student.index', compact('students', 'faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = $this->facultyRepo->getFaculty()->pluck('name', 'id');

        return view('student.form', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->all();
        $data['phone_telecom'] = StudentService::detectPhone($data['phone']);
        $data['slug'] = Str::slug($data['full_name']);
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalName();
            $get_image->move('images', $new_image);
            $data['image'] = $new_image;
        }
        $student = $this->studentRepo->create($data);

        $password = '@' . Str::slug($student->full_name, '') . $student->id;
        User::create([
            'name' => $student->full_name,
            'email' => $student->email,
            'password' => Hash::make($password),
            'permission' => 'student',
            'provider_id' => null,
            'provider' => null,

        ]);

        return redirect()->route('students.index')->with('success', 'Create student successful!');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
//        $student = $this->studentRepo->find($id);

        return view('student.detail', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($student)
    {
        $student = $this->studentRepo->find($student);
        $faculties = $this->facultyRepo->getFaculty()->pluck('name', 'id');

        return view('student.form', compact('student', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(StudentRequest $request, $student)
    {
        $data = $request->all();
        $student = $this->studentRepo->find($student);
        $get_image = $request->file('image');
        if ($get_image) {
            if (!empty($student->image)) {
                unlink('images/' . $student->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalName();
            $get_image->move('images', $new_image);
            $data['image'] = $new_image;
        }
        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Create student successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student)
    {
        $data = $this->studentRepo->find($student);
        if (!empty($student->image)) {
            unlink('images/' . $student->image);
        }
        $data->delete();

        return redirect()->route('students.index')->with('success', 'Deleted successfully!');

    }

    public function createSubject($student)
    {
        $subjects = $this->subjectRepo->getSubject();
        $student = $this->studentRepo->find($student);

        return view('student.register_subject', compact('student', 'subjects'));
    }

    public function storeSubject(Request $request)
    {
        $student_id = $request->input('student_id');
        $this->studentRepo->find($student_id)->subjects()->syncWithoutDetaching($request->subject_id);
        return redirect()->route('students.index')->with('success', 'Successfully!');
    }

    public function createMark($student_id)
    {
        $marks = ['' => '--Subject--'];
        $student = $this->studentRepo->find($student_id);
        $subjects = Subject::all()->pluck('name','id')->toArray();
        $subject_count = count($subjects);
        $selectedSubjects = Student::find($student_id)->subjects()->wherePivot('mark','>',0)->get();
        foreach ($selectedSubjects as $selectedSubject) {
            $marks[$selectedSubject->pivot->subject_id] = $selectedSubject->pivot->mark;
        }

        return view('student.addMark', compact('student','subject_count','selectedSubjects', 'marks', 'subjects'));
    }

    public function storeMark(StoreMarkRequest $request,$student_id)
    {
        if (isset($request->subject_ids)) {
            $data = [];
            foreach ($request->subject_ids as $key => $value) {
                array_push($data, [
                    'subject_id' => $request->subject_ids[$key],
                    'mark' => $request->marks[$key],
                ]);
            }
            $marks = [];
            foreach ($data as $key => $value) {
                $marks[$value['subject_id']] = ['mark' => $value['mark']];
            }

            $this->studentRepo->find($student_id)->subjects()->syncWithoutDetaching($marks);
        }

        return redirect()->route('students.index')->with('success', 'Successfully !');

    }

    public function updateApi(StudentRequest $request, $student)
    {
        try {
            $inputs = $request->all();
            $student = Student::findOrFail($student);

            if ($request->hasFile('image')) {
                $originName = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;
                $request->file('image')->move(public_path(Student::$upload_dir), $fileName);
                $inputs['image'] = $fileName;
            } else {
                $inputs['image'] = $student->image;
            }
            $student->update($inputs);

            $data = [
                'data' => $student,
                'message' => "Update success"
            ];
            return Response::json($data);
        } catch (\Exception $e) {
            return Response::json(['message' => $e->getMessage()], $e->getCode());
        }
    }


}

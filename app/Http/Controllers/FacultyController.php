<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $facultyRepo;

    public function __construct(FacultyRepositoryInterface $facultyRepo)
    {
        $this->facultyRepo = $facultyRepo;
    }

    public function index()
    {
        $faculties = $this->facultyRepo->getFaculty();
        return view('faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        {
            $data = $request->all();
            $faculty = $this->facultyRepo->create($data);
            return redirect()->route('faculties.index')->with('success', 'Create successfully!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyRepo->find($id);
        $faculties = $this->facultyRepo->getFaculty();

        return view('faculty.form', compact('faculty', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        $faculty = $this->facultyRepo->find($id);
        $faculty->update($request->all());

        return redirect()->route('faculties.index', compact('faculty'))
            ->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = $this->facultyRepo->find($id);
        $faculty->delete();

        return redirect()->route('faculties.index')->with('success', 'Delete successfully!');
    }
}

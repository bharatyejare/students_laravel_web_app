<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::select('*');
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('index');
    }

    public function getstudents(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('students')->select('name','roll_no','image','class_no', DB::raw('SUM(subject_score) as subject_score'))->groupBy('name','roll_no','image','class_no') ->orderByDesc('subject_score');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){   
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('student_marks');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'roll_no' => 'required|numeric',
            'subjects' => 'required|max:255',
            'subject_score' => 'required|max:255',
            'class_no' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $roll_no = Student::where([['roll_no', '=', $request->input('roll_no')],['class_no', '=', $request->input('class_no')]])->first();
        
        if (!empty($roll_no)) {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Roll No Already Allocated');
                window.location.href='http://127.0.0.1:8000/students/create';
                </script>");
        }   else {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $imageName = $request->image->extension(); 
                $storeData['image']='images/'.$filename.'.'.$imageName;
                $request->image->move(public_path('images'),$filename.'.'.$imageName);
                $student = Student::create($storeData);
                return redirect('/students')->with('completed', 'Student has been saved!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}

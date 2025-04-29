<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function list()
    {
        return Student::all();
    }

    public function addStudent(Request $request)
    {
        $rules = [
            'name'  => 'required | min:2 | max:10',
            'email' => 'required | email',
            'batch' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $student        = new Student();
        $student->name  = $request->name;
        $student->email = $request->email;
        $student->batch = $request->batch;
        $student->save();
        if ($student) {
            return "Student Added";
        } else {
            return "Failed to Add Student";
        }

    }

    public function updateStudent(Request $request)
    {
        $student        = Student::find($request->id);
        $student->name  = $request->name;
        $student->email = $request->email;
        $student->batch = $request->batch;
        $student->save();
        if ($student) {
            return "Student Updated";
        } else {
            return "Failed to Update Student";
        }
    }

}

<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function getStudents()
    {
        $students = \App\Models\Student::all();
        return $students;
    }

    public function addStudent(Request $request)
    {
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function store(Request $request)
    {
        //Validate the request
        $validated = $request->validate([
            'name' =>'required',
            'email' =>'required |email|unique:students,email',
            'phone' =>'required',
            'address' =>'required'
    ]);


        //Use the validated data to create a student
        $student=Student::create($validated);
    
        //Redirect back with success message
        return redirect()->route('dashboard')->with([
            'success' => 'Student added Successfully',
            'newStudent' => $student,
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('dashboard')->with('success_delete', 'Student deleted successfully');
    }
};


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'admission_number' => 'required|string|unique:students',
            'class' => 'required|string',
            'section' => 'required|string',
            'roll_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'parent_name' => 'required|string',
            'parent_phone' => 'required|string',
            'profile_photo' => 'nullable|image|max:2048'
        ]);

        DB::beginTransaction();
        try {
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'student'
            ]);

            if ($request->hasFile('profile_photo')) {
                $photoPath = $request->file('profile_photo')
                    ->store('studentUploads', 'public');
                $user->profile_photo = $photoPath;
                $user->save();
            }

            // Create student
            Student::create([
                'user_id' => $user->id,
                'admission_number' => $validated['admission_number'],
                'class' => $validated['class'],
                'section' => $validated['section'],
                'roll_number' => $validated['roll_number'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'parent_name' => $validated['parent_name'],
                'parent_phone' => $validated['parent_phone']
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')
                ->with('success', 'Student created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create student')
                ->withInput();
        }
    }
}

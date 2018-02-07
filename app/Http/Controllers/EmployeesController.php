<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeesController extends Controller
{
    //
    public function showAll() {

        return view('employees.list');
    }

    public function addShowForm() {
        return view('employees.add');
    }

    public function editShowForm($id) {

        return view('employees.edit')->with(['employee' => Employee::findOrFail($id)]);
    }

    public function add(Request $request) {
        $rules = [
            'first_name'    => 'required|string|max:60',
            'second_name'   => 'required|string|max:60',
            'features'      => 'nullable|string|max:254',
            'position_id'   => 'required|integer|exists:positions,id',
            'salary'        => 'nullable|numeric',
        ];
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }
        $position = Position::findOrFail($request->position_id);
        $position->employees()->save((new Employee)->fill($request->only(['first_name', 'second_name', 'features', 'salary'])));
        return response()->json();
    }

    public function save(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        $rules = [
            'first_name'    => 'required|string|max:60',
            'second_name'   => 'required|string|max:60',
            'features'      => 'nullable|string|max:254',
            'position_id'   => 'required|integer|exists:positions,id',
            'salary'        => 'nullable|numeric',
        ];
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }
        $employee->fill($request->only(['first_name', 'second_name', 'features', 'salary', 'position_id']));

        $employee->save();

        return response()->json();
    }

    public function get($id){
        $employee = Employee::findOrfail($id);
        return response($employee);

    }

    public function del($id) {
        $employee = Employee::findOrfail($id);

        $employee->delete();
        return response()->json();
    }
}

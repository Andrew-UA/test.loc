<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    //
    public function showAll() {
        return view('positions.list');
    }

    public function addShowForm() {
        return view('positions.add');
    }

    public function editShowForm($id) {
        $position = Position::findOrfail($id);

        return view('positions.edit')->with(['position' => $position]);
    }

    public function get($id){
        $position = Position::findOrfail($id);
        return response($position);

    }

    public function save(Request $request, $id) {
        $position = Position::findOrfail($id);
        $rules = [
            'name'          => 'required|string|max:60|min:2',
            'description'   => 'nullable|string|max:254'
        ];
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }
        $position->fill($request->only('name', 'description'))->save();
        return response()->json();
    }

    public function add(Request $request) {
        $rules = [
            'name'          => 'required|string|max:60|min:2',
            'description'   => 'nullable|string|max:254'
        ];
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }
        (new Position)->fill($request->only('name', 'description'))->save();
        return response()->json();
    }

    public function del($id) {
        $position = Position::findOrfail($id);

        if ($position->employees->isNotEmpty()) {
            return response()->json($position->employees, 400);
        }
        $position->delete();
        return response()->json();
    }

}

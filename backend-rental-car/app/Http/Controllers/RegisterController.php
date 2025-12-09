<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registers = Register::all();

        return response()->json($registers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data
        $validator = Validator::make($request->all(), [
            'no_ktp' => ['required'],
            'name' => ['required'],
            'date_of_birth' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'phone' => ['required'],
            'description' => ['required'],
        ]);

        // kalo validasinya gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        // create register
        $register = Register::create($validator->validated());

        return response()->json([
            'message' => 'create register success',
            'data' => $register,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Register $register)
    {
        //
    }
}

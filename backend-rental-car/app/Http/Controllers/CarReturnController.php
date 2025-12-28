<?php

namespace App\Http\Controllers;

use App\Models\CarReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carReturns = CarReturn::with(['register', 'car', 'penalties'])->get();

        return response()->json($carReturns);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tenant' => ['required', 'exists:registers,id'],
            'id_car' => ['required', 'exists:cars,id'],
            'id_penalties' => ['required', 'exists:penalties,id'],
            'date_borrow' => ['required'],
            'date_return' => ['required'],
            'penalties_total' => ['required'],
            'discount' => ['required'],
            'total' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors(),
            ], 422);
        }

        $carReturn = CarReturn::create($validator->validated());

        return response()->json([
            'message' => 'car return create success',
            'car_return' => $carReturn,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carReturn = CarReturn::find($id);

        if (!$carReturn) {
            return response()->json([
                'message' => 'car return not found'
            ], 404);
        }

        return response()->json($carReturn);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $carReturn = CarReturn::find($id);

        if (!$carReturn) {
            return response()->json([
                'message' => 'car return not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_tenant' => ['required', 'exists:registers,id'],
            'id_car' => ['required', 'exists:cars,id'],
            'id_penalties' => ['required', 'exists:penalties,id'],
            'date_borrow' => ['required'],
            'date_return' => ['required'],
            'penalties_total' => ['required'],
            'discount' => ['required'],
            'total' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors(),
            ], 422);
        }

        $carReturn->update($validator->validated());

        return response()->json([
            'message' => 'car return update success',
            'car_return' => $carReturn,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carReturn = CarReturn::find($id);

        if (!$carReturn) {
            return response()->json([
                'message' => 'car return not found'
            ], 404);
        }

        $carReturn->delete($id);

        return response()->json([
            'message' => 'car return delete success'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();

        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'no_car' => ['required'],
            'name_car' => ['required'],
            'type_car' => ['required'],
            'year' => ['required'],
            'seat' => ['required'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'total' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
        ]);

        // kalo error validasi
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        // data yang sudah di validasi oleh validator
        $validated = $validator->validated();

        // handle file upload
        if ($request->file('image')) {
            // simpan image, ambil url nya, add ke $validated
            $url = $request->file('image')->store('car', 'public');

            $validated['image'] = $url;
        }

        // create car
        $car = Car::create($validated);

        return response()->json([
            'message' => 'create car success',
            'data' => $car
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // cari car berdasarkan id
        $car = Car::find($id);

        // kalo ga ketemu
        if (!$car) {
            return response()->json([
                'message' => 'car not found',
            ], 404);
        }

        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // cari car berdasarkan id
        $car = Car::find($id);

        // kalo ga ketemu
        if (!$car) {
            return response()->json([
                'message' => 'car not found',
            ], 404);
        }

        // validasi input
        $validator = Validator::make($request->all(), [
            'no_car' => ['required'],
            'name_car' => ['required'],
            'type_car' => ['required'],
            'year' => ['required'],
            'seat' => ['required'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'total' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
        ]);

        // kalo error validasi
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        // data yang sudah di validasi oleh validator
        $validated = $validator->validated();

        // handle file image
        if ($request->file('image')) {
            // kalo ada image baru
            $url = $request->file('image')->store('car', 'public');

            // ngehapus image lama yg udh disimpen
            Storage::disk('public')->delete($car->image);

            $validated['image'] = $url;
        } else {
            // kalo ga ada image baru, pakai image lama
            $validated['image'] = $car->image;
        }

        // update car
        $car->update($validated);

        return response()->json([
            'message' => 'car updated',
            'data' => $car,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // cari car
        $car = Car::find($id);

        // kalo ga ketemu
        if (!$car) {
            return response()->json([
                'message' => 'car not found'
            ], 404);
        }

        // ngehapus image lama yg udh disimpen
        Storage::disk('public')->delete($car->image);

        // delete car
        $car->delete();

        return response()->json([
            'message' => 'delete car success',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Retal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class retalController extends Controller
{
    public function index()
    {
        $retales = Retal::all();

        $data = [
            'retales' => $retales,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'metros' => 'required|digits:4',
            'precio' => 'required|digits:4',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error al validar datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $retal = Retal::create([
            'nombre' => $request->nombre,
            'metros' => $request->metros,
            'precio' => $request->precio,
            'image' => $request->image
        ]);

        if (!$retal) {
            $data = [
                'message' => 'Error al crear retal',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'retal' => $retal,
            'status' => 201
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Retal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RetalController extends Controller
{
    /* VER TODOS LOS RETALES */
    public function index()
    {
        $retales = Retal::all();

        $data = [
            'retales' => $retales,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /* VER UN RETAL */
    public function show($id)
    {
        $retal = Retal::find($id);

        if (!$retal) {
            $data = [
                'message' => 'Retal no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'retal' => $retal,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /* CREAR RETALES */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'metros' => 'required',
            'precio' => 'required',
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

    /* EDITAR DATOS DE UN RETAL */
    public function update(Request $request, $id)
    {
        $retal = Retal::find($id);

        if (!$retal) {
            $data = [
                'message' => 'Retal no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'metros' => 'required',
            'precio' => 'required',
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

        $retal->nombre = $request->nombre;
        $retal->metros = $request->metros;
        $retal->precio = $request->precio;
        $retal->image = $request->image;

        $retal->save();

        $data = [
            'message' => 'Retal actualizado',
            'retal' => $retal,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /* EDITAR DATOS DE UN RETAL */
    public function updatePartial(Request $request, $id)
    {
        $retal = Retal::find($id);

        if (!$retal) {
            $data = [
                'message' => 'Retal no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => '',
            'metros' => '',
            'precio' => '',
            'image' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error al validar datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $retal->nombre = $request->nombre;
        }
        if ($request->has('metros')) {
            $retal->metros = $request->metros;
        }
        if ($request->has('precio')) {
            $retal->precio = $request->precio;
        }
        if ($request->has('image')) {
            $retal->image = $request->image;
        }

        $retal->save();

        $data = [
            'message' => 'Retal actualizado',
            'retal' => $retal,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /* ELIMINAR UN RETAL */
    public function destroy($id)
    {
        $retal = Retal::find($id);

        if (!$retal) {
            $data = [
                'message' => 'Retal no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $retal->delete();

        $data = [
            'message' => 'Retal eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}

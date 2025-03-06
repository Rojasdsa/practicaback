<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Retales\RetalesRequest;
use App\Models\Retal;
use Illuminate\Http\JsonResponse;

class RetalController extends Controller
{
    /* Método para estructurar respuestas JSON */
    private function respondJson($data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }

    /* VER TODOS LOS RETALES */
    public function index(): JsonResponse
    {
        return $this->respondJson(['retales' => Retal::all()]);
    }

    /* VER UN RETAL */
    public function show($id): JsonResponse
    {
        $retal = Retal::findOrFail($id);
        return $this->respondJson(['retal' => $retal]);
    }

    /* CREAR RETALES */
    public function store(RetalesRequest $request): JsonResponse
    {
        $retal = Retal::create($request->validated());

        return $this->respondJson([
            'message' => 'Retal creado exitosamente',
            'retal' => $retal
        ], 201);
    }

    /* EDITAR DATOS DE UN RETAL */
    public function update(RetalesRequest $request, $id): JsonResponse
    {
        $retal = Retal::findOrFail($id);
        $retal->update($request->validated());

        return $this->respondJson([
            'message' => 'Retal actualizado',
            'retal' => $retal
        ]);
    }

    /* EDITAR UN DATO DE UN RETAL (ACTUALIZACIÓN PARCIAL) */
    public function updatePartial(RetalesRequest $request, $id): JsonResponse
    {
        $retal = Retal::findOrFail($id);
        $retal->fill($request->only(['nombre', 'metros', 'precio', 'image']))->save();

        return $this->respondJson([
            'message' => 'Retal actualizado parcialmente',
            'retal' => $retal
        ]);
    }

    /* ELIMINAR UN RETAL */
    public function destroy($id): JsonResponse
    {
        Retal::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

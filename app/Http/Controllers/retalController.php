<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Retales\RetalesRequest;
use App\Models\Retal;
use App\Models\RetalImagen;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class RetalController extends Controller
{
    /* Método para estructurar respuestas JSON */
    private function respondJson($data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }

    /* #1 - VER TODOS LOS RETALES */
    public function index(): JsonResponse
    {
        $retales = Retal::with('imagenes')->get();
        return $this->respondJson(['retales' => $retales]);
    }

    /* #2 - VER UN RETAL */
    public function show($id): JsonResponse
    {
        $retal = Retal::with('imagenes')->findOrFail($id);
        return $this->respondJson(['retal' => $retal]);
    }

    /* #3 - CREAR UN RETAL */
    public function store(RetalesRequest $request): JsonResponse
    {
        $retal = Retal::create($request->validated());

        // Guardar imágenes en storage
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = Storage::disk('public')->put('media/retales', $imagen); // Se guarda en app/public/media/retales/
                RetalImagen::create([
                    'retal_id' => $retal->id,
                    'ruta_imagen' => $path
                ]);
            }
        }
        return $this->respondJson([
            'message' => 'Retal creado exitosamente',
            'retal' => $retal->load('imagenes')
        ], 201);
    }

    /* #4 - EDITAR UN RETAL */
    public function update(RetalesRequest $request, $id): JsonResponse
    {
        $retal = Retal::findOrFail($id);
        $retal->update($request->validated());

        return $this->respondJson([
            'message' => 'Retal actualizado',
            'retal' => $retal->load('imagenes')
        ]);
    }

    /* #5 - EDITAR UN DATO DE UN RETAL (ACTUALIZACIÓN PARCIAL) */
    public function updatePartial(RetalesRequest $request, $id): JsonResponse
    {
        $retal = Retal::findOrFail($id);

        $retal->fill($request->only([
            'nombre',
            'metros',
            'precio_base',
            'precio_retal',
            'tejido',
            'subcategoria',
            'gama',
            'color_primario',
            'color_secundario',
            'estado',
            'descripcion'
        ]))->save();

        // 🔹 ELIMINAR IMÁGENES (Si se envían IDs de imágenes a eliminar)
        if ($request->has('eliminar_imagenes')) {
            $imagenesAEliminar = RetalImagen::whereIn('id', $request->eliminar_imagenes)
                ->where('retal_id', $retal->id)
                ->get();

            foreach ($imagenesAEliminar as $imagen) {
                Storage::disk('public')->delete('/media/retales',$imagen); // Elimina el archivo
                $imagen->delete(); // Elimina de la BD
            }
        }

        // 🔹 AGREGAR NUEVAS IMÁGENES (Si se envían archivos)
        if ($request->hasFile('agregar_imagenes')) {
            foreach ($request->file('agregar_imagenes') as $imagen) {
                $path = $imagen->store('media/retales', 'local');
                RetalImagen::create([
                    'retal_id' => $retal->id,
                    'ruta_imagen' => $path
                ]);
            }
        }

        return $this->respondJson([
            'message' => 'Retal actualizado parcialmente',
            'retal' => $retal->load('imagenes')
        ]);
    }


    /* #6 - ELIMINAR UN RETAL */
    public function destroy($id): JsonResponse
    {
        $retal = Retal::findOrFail($id);

        // Eliminar imágenes físicas
        foreach ($retal->imagenes as $imagen) {
            Storage::disk('public')->delete('/media/retales',$imagen); // Elimina el archivo
            $imagen->delete();
        }

        $retal->delete();

        return response()->json(null, 204);
    }
}

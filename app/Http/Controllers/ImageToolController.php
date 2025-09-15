<?php

namespace App\Http\Controllers;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\Request;

// Storage: para guardar archivos en storage/app y generar URLs públicas.
use Illuminate\Support\Facades\Storage;
// Str: para generar un nombre único con uuid().
use Illuminate\Support\Str;

class ImageToolController extends Controller
{

    // Muestra el formulario para subir y procesar imágenes
    public function index()
    {
        return view('image-preview');
    }   

    public function process(Request $request)
    {
        
        $data = $request->validate([
            // Validación básica del archivo de imagen
            'image' => 'required|image|max:5120',
            // Validación del formato de la imagen, SOLO PUEDEN SER LOS DECLARADOS
            'format' => 'required|in:jpg,png,webp',
        ]);

        // Abre la imagen con Intervention Image, usando la ruta temporal donde Laravel guarda el archivo subido.
        $file = $request->file('image');

        // Crear una instancia de la imagen usando Intervention Image
        $img = Image::read($file->getPathname());

        // Formato seleccionado por el usuario
        $format = $data['format'];

        // Calidad de la imagen (0-100) 75 por defecto
        $quality = 75;

        /* 
            Generar un nombre único para la imagen usando uuid 
            Ruta donde se guardará la imagen procesada con el nombre único
        */

        $uuid = (string) Str::uuid();
        $path = "public/processed_images/{$uuid}.{$format}";

        // Convertir y guardar la imagen
        // Codificar la imagen según el formato seleccionado
        $encodedImage = $img->encodeByExtension($format, quality: $quality);

        // Guardar la imagen usando Storage
        Storage::put($path, (string) $encodedImage);

        // URL publica
        $publicUrl = Storage::url($path);

        return back()->with('done_url', $publicUrl);
    }

}
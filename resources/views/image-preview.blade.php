    <!doctype html>
    <html lang="es">
    <head>
    <meta charset="utf-8">
    <title>Gestor de Imágenes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-50 text-gray-900">
    <div class="max-w-3xl mx-auto p-6 space-y-6">

        <h1 class="text-2xl font-bold">Subir y convertir imagenes.</h1>

        {{-- Mensajes de validación --}}
        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded">
            <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <form
        action="{{ route('gestor.imagen.process') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4 bg-white p-4 rounded border"
        >
        @csrf
        
        {{-- Archivo --}}
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white-50 hover:bg-gray-200 border-gray-300 duration-300 ease-in-out">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir</span> o arrastre su archivo aquí</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Formatos comúnes: PNG, JPG, WEBP</p>
                </div>
                <input 
                    id="dropzone-file"
                    type="file"
                    name="image"
                    accept="image/*" 
                    class="hidden"
                    required
                    />
            </label>
        </div> 
        

        {{-- Formato de salida --}}
        <div>
            <label class="block mb-1 font-medium">Formato de salida</label>
            <select name="format" class="w-full border rounded p-2 bg-white">
                <option value="jpg">JPG</option>
                <option value="png">PNG</option>
                <option value="webp">WEBP</option>
            </select>
        </div>

        
        <p class="text-xs text-gray-500">
            Si pones solo uno (ancho o alto) se calcula el otro para mantener la proporción.  
            Si pones ambos, se encaja dentro del tamaño indicado sin deformar.
        </p>

        {{-- Vista previa (cliente) opcional --}}
        <div class="space-y-2">
            <p class="font-medium">Vista previa local (no se sube aún):</p>
            <img id="preview" class="max-h-72 rounded border hidden" alt="Vista previa">
        </div>

        <div class="w-full flex gap-3 justify-around">
            {{-- Botones --}}
            <button
                class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-800 duration-500 ease-in-out"
                type="submit"
            >
                Procesar
            </button>
            
            <a href="/gestor-imagen">
                <button class="px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-800 rounded" >
                        Ver imagenes
                </button>
            </a>
        </div>
        </form>

        {{-- Resultado --}}
        @if (session('done_url'))
        <div class="bg-white p-4 rounded border space-y-3">
            <p class="font-medium">Resultado:</p>
            <img src="{{ session('done_url') }}" alt="Resultado" class="max-h-96 border rounded">
            <div class="flex flex-wrap gap-2 items-center">
            <a
                href="{{ session('done_url') }}"
                download
                class="px-3 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700"
            >
                Descargar
            </a>
            <code class="text-xs sm:text-sm text-gray-700 break-all">{{ session('done_url') }}</code>
            </div>
        </div>
        @endif

    </div>
    

    <script>

        // Pequeña preview local del archivo seleccionado
        const input = document.getElementById('dropzone-file');
        const img   = document.getElementById('preview');

        input.addEventListener('change', (e) => {
        const file = e.target.files?.[0];
        if (!file) { img.classList.add('hidden'); img.src = ''; return; }
        const reader = new FileReader();
        reader.onload = () => {
            img.src = reader.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
        });

        
    </script>
    </body>
    </html>

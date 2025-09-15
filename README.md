# 📸 Gestor de Imágenes

Aplicación en **Laravel 10** que permite **subir imágenes** y convertirlas fácilmente a diferentes formatos de salida: **JPG, PNG y WEBP**.  
Incluye vista previa local, validación de formatos y almacenamiento de imágenes procesadas con URL pública.

---

## 🚀 Características

- Subida de imágenes mediante *drag & drop* o selector de archivo.
- Conversión a **JPG**, **PNG** o **WEBP** usando [Intervention Image v3](https://image.intervention.io/v3).
- Vista previa local antes de procesar.
- Resaltado visual de la opción seleccionada con TailwindCSS.
- Almacenamiento en `public/storage/processed_images/` / `storage/app/public/processed_images/` con nombre único (`uuid`).
- Descarga directa del archivo procesado.

---

## 🛠️ Tecnologías usadas

- [Laravel 10](https://laravel.com/) – Framework backend.
- [TailwindCSS](https://tailwindcss.com/) – Estilos y diseño responsivo.
- [Intervention Image v3](https://image.intervention.io/) – Procesamiento de imágenes.
- [Laravel Vite](https://laravel.com/docs/10.x/vite) – Compilación de assets.
- [Axios](https://axios-http.com/) – Manejo de peticiones (ya disponible vía NPM).

---

## 📦 Requisitos

- **PHP 8.1+**
- **Composer** y **Node.js (>=18)**
- **Laravel 10**

---

## ⚙️ Instalación

Clona el repositorio e instala dependencias:

```bash
git clone https://github.com/usuario/gestor-imagenes-laravel.git
cd gestor-imagenes

# Instalar dependencias PHP
composer install

# Instalar dependencias JS
npm install
````

Configura tu entorno:

```bash
cp .env.example .env
php artisan key:generate
```

Crea el enlace simbólico para acceder a imágenes públicas:

```bash
php artisan storage:link
```

Ejecuta el servidor de desarrollo:

```bash
php artisan serve
```

---

## 🌐 Rutas principales

| Ruta                     | Método | Acción                                        |
| ------------------------ | ------ | --------------------------------------------- |
| `/gestor-imagen`         | GET    | Mostrar formulario de subida y conversión     |
| `/gestor-imagen/process` | POST   | Procesar la imagen y devolver URL de descarga |

---

## 🖥️ Vista previa

Formulario principal (`resources/views/image-preview.blade.php`):

```blade
<form action="{{ route('gestor.imagen.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Subida de archivo -->
    <input type="file" name="image" accept="image/*" required>

    <!-- Formatos -->
    <label>
        <input type="radio" name="format" value="jpg" checked> JPG
    </label>
    <label>
        <input type="radio" name="format" value="png"> PNG
    </label>
    <label>
        <input type="radio" name="format" value="webp"> WEBP
    </label>

    <button type="submit">Procesar</button>
</form>
```

---

## 📝 Ejemplo de uso

1. Ingresa a [http://localhost:8000/gestor-imagen](http://localhost:8000/gestor-imagen).
2. Sube una imagen (`.jpg`, `.png`, `.webp`).
3. Selecciona el formato de salida (JPG, PNG, WEBP).
4. Haz clic en **Procesar**.
5. Descarga tu imagen procesada desde la vista de resultados.

---

## 📂 Estructura relevante

```
app/
 └── Http/Controllers/
     └── ImageToolController.php
resources/
 └── views/
     └── image-preview.blade.php
routes/
 └── web.php
public/
 └── storage/processed_images/   # Imágenes procesadas
```

---

## 👨‍💻 Autor

[Nick Ortega](https://github.com/OrtegaNidddd)

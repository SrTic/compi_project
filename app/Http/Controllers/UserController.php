<?php

namespace App\Http\Controllers; // ¡Este es el namespace CORRECTO para UserController!

use App\Models\User; // Importa el modelo User para interactuar con la tabla de usuarios
use App\Notifications\WelcomeEmail; // Añade esta línea
use Illuminate\Http\Request; // Para manejar las peticiones HTTP (validación, datos del formulario)
use Illuminate\Support\Facades\Hash; // Importa la clase Hash para encriptar contraseñas
use Illuminate\Support\Facades\Log; // Para posibles logs de errores
use Illuminate\Validation\ValidationException; // Para capturar y manejar errores de validación
use Illuminate\Validation\Rule; // Añade esta línea

class UserController extends Controller
{
    /**
     * Muestra una lista paginada y con búsqueda de usuarios.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Obtiene el término de búsqueda de la URL
        $query = User::query(); // Inicia una nueva consulta al modelo User

        // Si hay un término de búsqueda, aplica el filtro
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('rol', 'like', '%' . $search . '%');
            });
        }

        // Pagina los resultados, 10 usuarios por página
        $users = $query->paginate(10);

        // Retorna la vista 'users.index' con los usuarios paginados y el término de búsqueda
        return view('users.index', compact('users', 'search'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Definir las reglas de validación
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', 'string', Rule::in(['administrador', 'usuario'])],
        ]);

        // 2. Crear el usuario si la validación es exitosa
        // ¡IMPORTANTE: Asignar el usuario creado a una variable $user!
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'rol' => $validatedData['rol'],
        ]);

        // 3. Enviar correo de bienvenida al nuevo usuario
        // Ahora $user está definido y podemos llamar al método notify()
        $user->notify(new WelcomeEmail($user));

        // 4. Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }


    /**
     * Muestra los detalles de un usuario específico.
     * Usa Route Model Binding: Laravel automáticamente encuentra el usuario por el ID en la URL.
     */
    public function show(User $usuario)
    {
        return view('users.show', compact('usuario'));
    }

    /**
     * Muestra el formulario para editar un usuario específico.
     * Usa Route Model Binding.
     */
    public function edit(User $usuario)
    {
        return view('users.edit', compact('usuario'));
    }

    /**
     * Actualiza un usuario específico en la base de datos.
     * Usa Route Model Binding.
     */
    public function update(Request $request, User $usuario)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id, // Email único, excepto para el usuario actual
                'rol' => 'required|string|in:administrador,usuario',
            ];

            // Solo valida la contraseña si el campo no está vacío
            if ($request->filled('password')) {
                $rules['password'] = 'string|min:8|confirmed';
            }

            // Valida los datos
            $validatedData = $request->validate($rules);

            // Actualiza los campos del usuario
            $usuario->name = $validatedData['name'];
            $usuario->email = $validatedData['email'];
            $usuario->rol = $validatedData['rol'];

            // Si se proporcionó una nueva contraseña, encriptarla y guardarla
            if ($request->filled('password')) {
                $usuario->password = Hash::make($validatedData['password']);
            }

            $usuario->save(); // Guarda los cambios en la base de datos

            // Redirige a la lista de usuarios con un mensaje de éxito
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (ValidationException $e) {
            // Si la validación falla
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Captura cualquier otra excepción
            Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el usuario.')->withInput();
        }
    }

    /**
     * Elimina un usuario específico de la base de datos.
     * Usa Route Model Binding.
     */
    public function destroy(User $usuario)
    {
        try {
            $usuario->delete(); // Elimina el usuario
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el usuario.');
        }
    }
}
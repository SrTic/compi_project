@extends('layouts.app') {{-- Asegúrate de que esto esté bien --}}

@section('content')

    {{-- Contenedor principal para el formulario de edición de usuarios --}}
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- Mensajes Flash de Éxito y Error (si aplica en este contexto) --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Mensajes de validación de Laravel (errores de formulario) --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Título del formulario --}}
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Editar Usuario: {{ $usuario->name }}</h1>

            {{-- Formulario de edición de usuario --}}
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Importante para las actualizaciones en recursos RESTful --}}

                {{-- Campo Nombre --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}" required autofocus
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo Contraseña (Opcional: solo si se quiere cambiar) --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña (dejar en blanco para no cambiar)</label>
                    <input type="password" name="password" id="password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo Confirmar Contraseña (Opcional: solo si se quiere cambiar) --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>

                {{-- Campo Rol --}}
                <div class="mb-6">
                    <label for="rol" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
                    <select name="rol" id="rol" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="usuario" {{ old('rol', $usuario->rol) == 'usuario' ? 'selected' : '' }}>Usuario</option>
                        <option value="administrador" {{ old('rol', $usuario->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('rol')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Botones de acción --}}
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('usuarios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
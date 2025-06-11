@extends('layouts.app') {{-- Asegúrate de que esto esté bien --}}

@section('content')

    {{-- Contenedor principal para la página de gestión de usuarios --}}
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        {{-- Mensajes Flash de Éxito --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensajes Flash de Error (ej. de AdminMiddleware o validación) --}}
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

        {{-- Título de la página --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestión de Usuarios</h1>

        {{-- Botón/Enlace para Crear Nuevo Usuario --}}
        <a href="{{ route('usuarios.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 shadow-md">
            Crear Nuevo Usuario
        </a>

        {{-- Formulario de búsqueda --}}
        <form action="{{ route('usuarios.index') }}" method="GET" class="flex items-center space-x-2 mb-4">
            <input type="text" name="search" placeholder="Buscar usuarios..." value="{{ request('search') }}"
                   class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline flex-grow">
            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded shadow">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('usuarios.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                    Limpiar Búsqueda
                </a>
            @endif
        </form>

        {{-- Tabla de Usuarios --}}
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">ID</th>
                        <th scope="col" class="py-3 px-6">Nombre</th>
                        <th scope="col" class="py-3 px-6">Email</th>
                        <th scope="col" class="py-3 px-6">Rol</th>
                        <th scope="col" class="py-3 px-6">Activo</th>
                        <th scope="col" class="py-3 px-6">Fecha Registro</th>
                        <th scope="col" class="py-3 px-6">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-4 px-6">{{ $user->id }}</td>
                            <td class="py-4 px-6">{{ $user->name }}</td>
                            <td class="py-4 px-6">{{ $user->email }}</td>
                            <td class="py-4 px-6">{{ $user->rol }}</td>
                            <td class="py-4 px-6">{{ $user->activo ? 'Sí' : 'No' }}</td>
                            <td class="py-4 px-6">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="py-4 px-6">
                                <a href="{{ route('usuarios.edit', $user->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Editar</a>
                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>

@endsection

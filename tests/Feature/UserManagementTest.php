<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; // Importa el modelo User
use Illuminate\Support\Facades\Hash; // Para crear contraseñas hasheadas en las pruebas

class UserManagementTest extends TestCase
{
    use RefreshDatabase; // Esto resetea la base de datos para cada prueba, muy útil.

    /**
     * Crea un usuario admin para las pruebas.
     */
    protected function createAdminUser()
    {
        return User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin_test@example.com',
            'password' => Hash::make('password'),
            'rol' => 'administrador',
        ]);
    }

    /**
     * Crea un usuario normal para las pruebas.
     */
    protected function createUser()
    {
        return User::factory()->create([
            'name' => 'User Test',
            'email' => 'user_test@example.com',
            'password' => Hash::make('password'),
            'rol' => 'usuario',
        ]);
    }

    /** @test */
    public function only_admins_can_view_users_list()
    {
        // Escenario 1: Usuario no autenticado
        $response = $this->get('/usuarios');
        $response->assertRedirect('/login'); // Debe redirigir al login

        // Escenario 2: Usuario normal autenticado
        $user = $this->createUser();
        $response = $this->actingAs($user)->get('/usuarios');
        $response->assertStatus(302); // Esperamos una redirección (al dashboard)
        $response->assertRedirect('/dashboard'); // Y que sea al dashboard
        $response->assertSessionHas('error', 'Acceso denegado. Solo administradores pueden acceder a esta sección.'); // Verifica el mensaje flash

        // Escenario 3: Usuario administrador autenticado
        $admin = $this->createAdminUser();
        $response = $this->actingAs($admin)->get('/usuarios');
        $response->assertStatus(200); // Debe permitir el acceso (código 200 OK)
        $response->assertSee('Gestión de Usuarios'); // Verifica que se vea el título de la página
        $response->assertSee('Crear Nuevo Usuario'); // Verifica que se vea el botón de crear
    }

    /** @test */
    public function guest_cannot_view_users_list()
    {
        $response = $this->get('/usuarios');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function normal_user_cannot_view_users_list()
    {
        $user = $this->createUser();
        $response = $this->actingAs($user)->get('/usuarios');
        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function admin_can_view_users_list()
    {
        $admin = $this->createAdminUser();
        $response = $this->actingAs($admin)->get('/usuarios');
        $response->assertOk(); // Esto es lo mismo que assertStatus(200)
        $response->assertSee('Gestión de Usuarios');
    }

    // Puedes añadir más pruebas aquí, por ejemplo:
    // - Probar que solo el admin puede crear, editar, eliminar usuarios.
    // - Probar la validación del formulario de creación/edición.
}
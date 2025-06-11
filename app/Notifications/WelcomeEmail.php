<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User; // Importa el modelo User

class WelcomeEmail extends Notification
{
    use Queueable;

    protected $user; // Propiedad para almacenar el usuario al que se envía el correo

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user) // Constructor para recibir el usuario
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail']; // Esta notificación se enviará por correo electrónico
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('¡Bienvenido a ' . config('app.name') . '!') // Asunto del correo
                    ->greeting('Hola ' . $this->user->name . '!') // Saludo
                    ->line('Gracias por registrarte en ' . config('app.name') . '.') // Primera línea del cuerpo
                    ->line('Tu rol asignado es: ' . $this->user->rol . '.') // Información sobre el rol
                    ->action('Visita nuestra aplicación', url('/dashboard')) // Botón en el correo
                    ->line('¡Esperamos que disfrutes usando nuestra plataforma!'); // Última línea
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
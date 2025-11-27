<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAppointmentAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Appointment $appointment
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');

        return (new MailMessage)
            ->subject('New Appointment Request - '.$this->appointment->name)
            ->greeting('New Appointment Request')
            ->line('A new appointment has been requested and requires your attention.')
            ->line('**Client Information:**')
            ->line('**Name:** '.$this->appointment->name)
            ->line('**Email:** '.$this->appointment->email)
            ->line('**Phone:** '.$this->appointment->phone)
            ->line('**Preferred Contact:** '.ucfirst($this->appointment->preferred_contact))
            ->line('**Appointment Details:**')
            ->line('**Date:** '.$this->appointment->formatted_date)
            ->line('**Time:** '.$this->appointment->formatted_time)
            ->when($this->appointment->notes, function ($message) {
                return $message->line('**Notes:** '.$this->appointment->notes);
            })
            ->action('View Appointment', route('admin.appointments.show', $this->appointment))
            ->line('Please review and confirm this appointment as soon as possible.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'type' => 'new_appointment',
        ];
    }
}

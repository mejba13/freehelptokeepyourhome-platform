<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentBooked extends Notification implements ShouldQueue
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
        $phone = SiteSetting::get('phone_primary');

        return (new MailMessage)
            ->subject('Appointment Request Received - '.$siteName)
            ->greeting('Hello '.$this->appointment->name.'!')
            ->line('Thank you for scheduling an appointment with '.$siteName.'. We have received your request and will review it shortly.')
            ->line('**Appointment Details:**')
            ->line('**Date:** '.$this->appointment->formatted_date)
            ->line('**Time:** '.$this->appointment->formatted_time)
            ->line('**Status:** Pending Confirmation')
            ->line('We will contact you within 24 hours to confirm your appointment via your preferred contact method ('.$this->appointment->preferred_contact.').')
            ->when($phone, function ($message) use ($phone) {
                return $message->line('If you need immediate assistance, please call us at: '.$phone);
            })
            ->line('Thank you for choosing '.$siteName.' for your housing counseling needs.')
            ->salutation('Best regards,<br>The '.$siteName.' Team');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'type' => 'appointment_booked',
        ];
    }
}

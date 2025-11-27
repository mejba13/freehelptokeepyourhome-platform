<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Appointment $appointment,
        public string $oldStatus
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $siteName = SiteSetting::get('site_name', 'Free Help To Keep Your Home');
        $phone = SiteSetting::get('phone_primary');

        $message = (new MailMessage)
            ->greeting('Hello '.$this->appointment->name.'!');

        switch ($this->appointment->status) {
            case Appointment::STATUS_CONFIRMED:
                $message
                    ->subject('Appointment Confirmed - '.$siteName)
                    ->line('Great news! Your appointment has been confirmed.')
                    ->line('**Appointment Details:**')
                    ->line('**Date:** '.$this->appointment->formatted_date)
                    ->line('**Time:** '.$this->appointment->formatted_time)
                    ->line('Please arrive a few minutes early and bring any relevant documents related to your housing situation.')
                    ->line('If you need to reschedule or cancel, please contact us at least 24 hours in advance.');
                break;

            case Appointment::STATUS_CANCELLED:
                $message
                    ->subject('Appointment Cancelled - '.$siteName)
                    ->line('Your appointment has been cancelled.');

                if ($this->appointment->cancellation_reason) {
                    $message->line('**Reason:** '.$this->appointment->cancellation_reason);
                }

                $message
                    ->line('**Original Date:** '.$this->appointment->formatted_date)
                    ->line('**Original Time:** '.$this->appointment->formatted_time)
                    ->line('If you would like to reschedule, please visit our website to book a new appointment.')
                    ->action('Book New Appointment', route('book-appointment'));
                break;

            case Appointment::STATUS_COMPLETED:
                $message
                    ->subject('Thank You for Your Visit - '.$siteName)
                    ->line('Thank you for visiting us on '.$this->appointment->formatted_date.'.')
                    ->line('We hope our consultation was helpful. If you have any follow-up questions or need additional assistance, please don\'t hesitate to reach out.')
                    ->line('Remember, our services are always free and confidential.');
                break;

            default:
                $message
                    ->subject('Appointment Update - '.$siteName)
                    ->line('Your appointment status has been updated to: '.ucfirst($this->appointment->status))
                    ->line('**Date:** '.$this->appointment->formatted_date)
                    ->line('**Time:** '.$this->appointment->formatted_time);
        }

        if ($phone) {
            $message->line('If you have any questions, please call us at: '.$phone);
        }

        return $message->salutation('Best regards,<br>The '.$siteName.' Team');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->appointment->status,
            'type' => 'appointment_status_changed',
        ];
    }
}

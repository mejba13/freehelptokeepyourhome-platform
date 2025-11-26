<?php

namespace App\Observers;

use App\Mail\ContactSubmissionNotification;
use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionObserver
{
    public function created(ContactSubmission $submission): void
    {
        $adminEmail = SiteSetting::get('email');

        if ($adminEmail) {
            Mail::to($adminEmail)->queue(new ContactSubmissionNotification($submission));
        }
    }
}

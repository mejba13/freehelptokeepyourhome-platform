<x-mail::message>
# New Contact Form Submission

You have received a new contact form submission from your website.

**From:** {{ $submission->name }}

**Email:** {{ $submission->email }}

@if($submission->phone)
**Phone:** {{ $submission->phone }}
@endif

**Message:**

{{ $submission->message }}

---

**Submitted:** {{ $submission->created_at->format('F j, Y \a\t g:i A') }}

**IP Address:** {{ $submission->ip_address }}

<x-mail::button :url="route('admin.submissions.show', $submission)">
View Submission
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

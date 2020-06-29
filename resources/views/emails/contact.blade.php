@component('mail::message')
## There is a ner contact form mail

***

**Name**: {{ $data['name'] }}

**Email**: {{ $data['email'] }}

**Subject**: {{ $data['subject'] }}

***

**Message**

{{ $data['body'] }}
@endcomponent

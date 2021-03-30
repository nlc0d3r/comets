@component('mail::message')

{!! $Email->body !!}

--<br>
Ar Cieņu,<br>
{{ $User->name }} {{ $User->surname }}<br>
{{ $User->email }}

<small>Nosūtīts: {{ $Email->created_at }}</small>

@endcomponent
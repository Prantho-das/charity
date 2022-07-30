@component('mail::message')
# Blood Donor Coming

{{$acceptedBy->name}} is coming for donate blood.
phone: {{$acceptedBy->phone}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

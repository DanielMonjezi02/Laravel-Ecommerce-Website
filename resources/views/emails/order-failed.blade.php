@component('mail::message')

Hello {{ $name }},

Your order has failed. Please try again by clicking the button below and clicking checkout

@component('mail::button', ['url' => 'http://localhost/cart'])
Visit Site
@endcomponent

@endcomponent


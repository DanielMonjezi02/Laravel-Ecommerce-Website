@component('mail::message')

Hello {{ $name }},

Your order has been cancelled. You can try place an order again by clicking the link below and clicking "Checkout"

@component('mail::button', ['url' => 'http://localhost/cart'])
Visit Site
@endcomponent

@endcomponent


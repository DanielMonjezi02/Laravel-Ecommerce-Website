@component('mail::message')

Hello {{ $username }},

We would like to wish you a happy birthday! To celebrate your birthday, we have given you a £3 OFF coupon to use once on our website!

Coupon Code: {{ $coupon }}

@endcomponent


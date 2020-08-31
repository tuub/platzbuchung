@component('mail::message')
# {{ $location->name }}

# {{ $date->getTranslatedDayName() }}, {{ $date->format('d.m.Y') }}

**Buchungen:** {{ $bookings }}

**Check-Ins:** {{ $check_ins }}

**Check-Outs:** {{ $check_outs }}

**Buchungen mit Check-In:** {{ $booking_checkin_ratio }} %

**Check-Ins mit Check-Out:** {{ $checkin_checkout_ratio }} %

**Gesamtkunden:** {{ $users }}

Viele Grüße,<br>
{{ config('app.name') }}
@endcomponent

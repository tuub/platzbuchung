@component('mail::message')
# {{ $location->name }}

# {{ $date->getTranslatedDayName() }}, {{ $date->format('d.m.Y') }}

**@lang('app.mail.daily_stats.bookings'):** {{ $bookings }}

**@lang('app.mail.daily_stats.check_ins'):** {{ $check_ins }}

**@lang('app.mail.daily_stats.check_outs'):** {{ $check_outs }}

**@lang('app.mail.daily_stats.bookings_with_check_in'):** {{ $booking_checkin_ratio }} %

**@lang('app.mail.daily_stats.check_ins_with_check_out'):** {{ $checkin_checkout_ratio }} %

**@lang('app.mail.daily_stats.total_users'):** {{ $users }}

**@lang('app.mail.daily_stats.total_logins'):** {{ $logins }}

@lang('app.mail.daily_stats.goodbye'),<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# @lang('app.mail.booking_confirmation.title')

@lang('app.mail.booking_confirmation.intro')

@component('mail::panel')
**@lang('app.mail.booking_confirmation.address'):** {{ $location->name }}, {{ $location->address }}<br>
**@lang('app.mail.booking_confirmation.resource'):** <span class="p-2" style="background-color: {{ $booking->resource->color }}; color: {{  $booking->resource->text_color }};">{{ $booking->resource->short_name }}</span><br>
**@lang('app.mail.booking_confirmation.user_barcode'):** {{ $booking->user->barcode }}<br>
**@lang('app.mail.booking_confirmation.date'):** {{$booking->date->translatedFormat('D, d.m.Y') }}<br>
**@lang('app.mail.booking_confirmation.time'):** @lang('app.mail.booking_confirmation.time_value', ['booking_start' => $booking->start->format('H:i'), 'booking_end' => $booking->end->format('H:i')])
@endcomponent

@lang('app.mail.booking_confirmation.advice_library_card')
<br>

## @lang('app.mail.booking_confirmation.usage_notes_general_hl')

@foreach($usage_notes_general as $usage_note)
* {!! $usage_note !!}
@endforeach

## @lang('app.mail.booking_confirmation.usage_notes_in_practice_hl')

@if ($location->is_pre_check_in_displayed && $location->allowed_minutes_for_pre_check_in > 0)
* @lang('app.mail.booking_confirmation.pre_check_in', ['allowed_minutes_for_pre_check_in' => $location->allowed_minutes_for_pre_check_in])
@endif

@foreach($usage_notes_in_practice as $usage_note)
* {!! $usage_note !!}
@endforeach

<br><br>
@lang('app.mail.booking_confirmation.goodbye')<br>
{{ env('APP_OWNER') }}
@endcomponent

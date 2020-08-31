@component('mail::message')
# @lang('app.mail.title')

@lang('app.mail.intro')

@component('mail::panel')
**@lang('app.mail.address'):** {{ $location->name }}, {{ $location->address }}<br>
**@lang('app.mail.resource'):** <span class="p-2" style="background-color: {{ $booking->resource->color }}; color: {{  $booking->resource->text_color }};">{{ $booking->resource->short_name }}</span><br>
**@lang('app.mail.user_barcode'):** {{ $booking->user->barcode }}<br>
**@lang('app.mail.date'):** {{$booking->date->translatedFormat('D, d.m.Y') }}<br>
**@lang('app.mail.time'):** @lang('app.mail.time_value', ['booking_start' => $booking->start->format('H:i'), 'booking_end' => $booking->end->format('H:i')])
@endcomponent

@lang('app.mail.advice_library_card')
<br>

## @lang('app.mail.usage_notes_general_hl')

@foreach($usage_notes_general as $usage_note)
* {!! $usage_note !!}
@endforeach

## @lang('app.mail.usage_notes_in_practice_hl')

@foreach($usage_notes_in_practice as $usage_note)
* {!! $usage_note !!}
@endforeach

<br><br>
@lang('app.mail.goodbye')<br>
{{ env('APP_OWNER') }}
@endcomponent

@component('mail::message')
# @lang('app.mail.title')

@lang('app.mail.intro')

@component('mail::panel')
**@lang('app.mail.address'):** {{ $booking->resource->address }}<br>
**@lang('app.mail.resource'):** <span class="p-2" style="background-color: {{ $booking->resource->color }}; color: {{  $booking->resource->text_color }};">{{ $booking->resource->short_name }}</span><br>
**@lang('app.mail.user_barcode'):** {{ $booking->user->barcode }}<br>
**@lang('app.mail.date'):** {{$booking->date->translatedFormat('D, d.m.Y') }}<br>
**@lang('app.mail.time'):** @lang('app.mail.time_value', ['booking_start' => $booking->start->format('H:i'), 'booking_end' => $booking->end->format('H:i')])
@endcomponent

@lang('app.mail.advice_library_card')
<br>

## @lang('app.mail.usage_notes_general_hl')

* @lang('app.mail.usage_notes_general.usage_notes_general_1')

* @lang('app.mail.usage_notes_general.usage_notes_general_2')

* @lang('app.mail.usage_notes_general.usage_notes_general_3')

* @lang('app.mail.usage_notes_general.usage_notes_general_4')

* @lang('app.mail.usage_notes_general.usage_notes_general_5')

* @lang('app.mail.usage_notes_general.usage_notes_general_6')

* @lang('app.mail.usage_notes_general.usage_notes_general_7')

* @lang('app.mail.usage_notes_general.usage_notes_general_8')

## @lang('app.mail.usage_notes_in_practice_zb_hl')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_1')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_2')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_3')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_4')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_5')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_6')

* @lang('app.mail.usage_notes_in_practice_zb.usage_notes_in_practice_7')

## @lang('app.mail.usage_notes_in_practice_mathebib_hl')

* @lang('app.mail.usage_notes_in_practice_mathebib.usage_notes_in_practice_1')

* @lang('app.mail.usage_notes_in_practice_mathebib.usage_notes_in_practice_2')

* @lang('app.mail.usage_notes_in_practice_mathebib.usage_notes_in_practice_3')

<br><br>
@lang('app.mail.goodbye')<br>
{{ env('APP_OWNER') }}
@endcomponent

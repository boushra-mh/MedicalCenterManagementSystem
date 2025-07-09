@component('mail::message')
# تحديث حالة الموعد

مرحباً {{ $appointment->user?->name ?? 'المستخدم' }},

تم تحديث حالة موعدك مع الدكتور {{ $appointment->doctor?->name ?? 'الدكتور' }} بتاريخ {{ $appointment->date }} في الساعة {{ $appointment->time }} لتصبح الحالة:  
**{{ ucfirst(__($appointment->status?->value ?? 'غير معروفة')) }}**.

شكراً لاستخدامك {{ config('app.name') }}.

@component('mail::button', ['url' => route('appointment.status', $appointment->id)])
عرض تفاصيل الموعد
@endcomponent

تحياتنا،  
{{ config('app.name') }}
@endcomponent

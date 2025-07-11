<?php $__env->startComponent('mail::message'); ?>
# <?php echo new \Illuminate\Support\EncodedHtmlString(__('messages.appointment_status_updated')); ?>


<?php echo new \Illuminate\Support\EncodedHtmlString(__('messages.hello_user', ['name' => $appointment->user?->name ?? __('messages.user')])); ?>


<?php echo new \Illuminate\Support\EncodedHtmlString(__('messages.appointment_updated_to', [
    'doctor' => $appointment->doctor?->name ?? __('messages.the_doctor'),
    'date' => $appointment->date,
    'time' => $appointment->time,
    'status' => ucfirst(__("messages." . ($appointment->status?->value ?? 'unknown')))
])); ?>


<?php echo new \Illuminate\Support\EncodedHtmlString(__('messages.thank_you_for_using', ['app' => config('app.name')])); ?>


<?php $__env->startComponent('mail::button', ['url' => route('appointment.status', $appointment->id)]); ?>
<?php echo new \Illuminate\Support\EncodedHtmlString(__('messages.view_appointment_details')); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo new \Illuminate\Support\EncodedHtmlString(__('messages.regards')); ?>,  
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/emails/appointment/status.blade.php ENDPATH**/ ?>
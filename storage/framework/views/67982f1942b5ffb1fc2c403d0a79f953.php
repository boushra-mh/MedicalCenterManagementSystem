<?php $__env->startComponent('mail::message'); ?>
 <?php echo new \Illuminate\Support\EncodedHtmlString(__('Appointment Confirmation')); ?>


<?php echo new \Illuminate\Support\EncodedHtmlString(__('Dear')); ?> <?php echo new \Illuminate\Support\EncodedHtmlString($user->name); ?>,

<?php echo new \Illuminate\Support\EncodedHtmlString(__('Your appointment has been booked successfully.')); ?>


<?php echo new \Illuminate\Support\EncodedHtmlString(__('Appointment Details:')); ?>


- <?php echo new \Illuminate\Support\EncodedHtmlString(__('Doctor')); ?>: <?php echo new \Illuminate\Support\EncodedHtmlString($doctor->name); ?>

- <?php echo new \Illuminate\Support\EncodedHtmlString(__('Date')); ?>: <?php echo new \Illuminate\Support\EncodedHtmlString($appointment->date); ?>

- <?php echo new \Illuminate\Support\EncodedHtmlString(__('Time')); ?>: <?php echo new \Illuminate\Support\EncodedHtmlString($appointment->time); ?>


<?php echo new \Illuminate\Support\EncodedHtmlString(__('Thank you for choosing our medical center!')); ?>


<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/emails/appointments/confirmed.blade.php ENDPATH**/ ?>
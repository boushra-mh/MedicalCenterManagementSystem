<?php $__env->startComponent('mail::message'); ?>
# تحديث حالة الموعد

مرحباً <?php echo new \Illuminate\Support\EncodedHtmlString($appointment->user->name); ?>,

تم تحديث حالة موعدك مع الدكتور <?php echo new \Illuminate\Support\EncodedHtmlString($appointment->doctor->name); ?> بتاريخ <?php echo new \Illuminate\Support\EncodedHtmlString($appointment->date); ?> في الساعة <?php echo new \Illuminate\Support\EncodedHtmlString($appointment->time); ?> لتصبح الحالة:  
**<?php echo new \Illuminate\Support\EncodedHtmlString(ucfirst(__($appointment->status->value))); ?>**.

شكراً لاستخدامك <?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>.

<?php $__env->startComponent('mail::button', ['url' => route('appointment.status', $appointment->id)]); ?>
عرض تفاصيل الموعد
<?php echo $__env->renderComponent(); ?>

تحياتنا،  
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/emails/appointment/status.blade.php ENDPATH**/ ?>
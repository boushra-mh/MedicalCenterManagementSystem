
<?php $__env->startSection('title', 'لوحة الطبيب'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>مرحباً بك في لوحة الطبيب</h2>

    <h4 class="mt-4">📅 مواعيد اليوم</h4>

    <?php if($appointmentsToday->isEmpty()): ?>
        <p>لا يوجد مواعيد مجدولة لليوم.</p>
    <?php else: ?>
        <div class="row">
            <?php $__currentLoopData = $appointmentsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('doctor.dashboard.partials._appointment_card', ['appointment' => $appointment], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/dashboard.blade.php ENDPATH**/ ?>
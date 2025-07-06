
<?php $__env->startSection('title', 'كل المواعيد'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>كل المواعيد</h2>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-select">
                <option value="">الكل</option>
                <option value="confirmed" <?php echo e(request('status') == 'confirmed' ? 'selected' : ''); ?>>مؤكد</option>
                <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>ملغي</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>قيد الانتظار</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">التاريخ</label>
            <input type="date" name="date" class="form-control" value="<?php echo e(request('date')); ?>">
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary">تصفية</button>
        </div>
    </form>

    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('doctor.dashboard.partials._appointment_card', ['appointment' => $appointment], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo e($appointments->withQueryString()->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/appointments.blade.php ENDPATH**/ ?>
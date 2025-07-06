
<?php $__env->startSection('title', 'الملف الشخصي'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">الملف الشخصي</h5>
    </div>
    <div class="card-body">
        <p><strong>الاسم:</strong> <?php echo e(auth('doctor_web')->user()->name); ?></p>
        <p><strong>البريد الإلكتروني:</strong> <?php echo e(auth('doctor_web')->user()->email); ?></p>
        <p><strong>الحالة:</strong>
            <?php if(auth('doctor_web')->user()->status == \App\Enums\StatusEnum::Active->value): ?>
                <span class="badge bg-success">نشط</span>
            <?php else: ?>
                <span class="badge bg-secondary">غير نشط</span>
            <?php endif; ?>
        </p>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/profile.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">لوحة التحكم - إحصائيات اليوم</h2>

    <div class="row text-center">
        <div class="col-md-3">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h5>مواعيد اليوم</h5>
                    <h2><?php echo e($stats['today']); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>المؤكدة</h5>
                    <h2><?php echo e($stats['confirmed']); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">
                    <h5>الملغاة</h5>
                    <h2><?php echo e($stats['cancelled']); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark mb-3">
                <div class="card-body">
                    <h5>المعلقة</h5>
                    <h2><?php echo e($stats['pending']); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h4>📅 مواعيد اليوم</h4>
    <?php if($appointmentsToday->isEmpty()): ?>
        <p class="text-muted">لا توجد مواعيد اليوم.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php $__currentLoopData = $appointmentsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?php echo e($appointment->user?->name ?? 'مريض غير معروف'); ?>

                    <span><?php echo e($appointment->date); ?> | <?php echo e($appointment->time); ?></span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.doctor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/dashboard.blade.php ENDPATH**/ ?>
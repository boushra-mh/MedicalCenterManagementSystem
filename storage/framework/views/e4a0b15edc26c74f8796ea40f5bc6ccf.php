

<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">لوحة التحكم</h2>

    <!-- بطاقات الإحصائيات -->
    <div class="row text-center">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>كل المواعيد</h5>
                    <h3><?php echo e($stats['total']); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>مواعيد مؤكدة</h5>
                    <h3><?php echo e($stats['confirmed']); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>مواعيد ملغاة</h5>
                    <h3><?php echo e($stats['canceled']); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>مواعيد معلقة</h5>
                    <h3><?php echo e($stats['pending']); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- جدول مواعيد اليوم -->
    <div class="mt-5">
        <h4>مواعيد اليوم</h4>
        <?php if($appointmentsToday->isEmpty()): ?>
            <div class="alert alert-info">لا يوجد مواعيد اليوم.</div>
        <?php else: ?>
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>الطبيب</th>
                        <th>الوقت</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $appointmentsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $status = $appointment->status instanceof \BackedEnum
                                ? $appointment->status->value
                                : (string) $appointment->status;

                            $colors = [
                                'pending' => 'warning',
                                'confirmed' => 'success',
                                'canceled' => 'danger'
                            ];
                        ?>
                        <tr>
                            <td><?php echo e($appointment->doctor?->name ?? '-'); ?></td>
                            <td><?php echo e($appointment->time); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($colors[$status] ?? 'secondary'); ?>">
                                    <?php echo e(__($status)); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- عرض قائمة التخصصات -->
    <div class="mt-5">
        <h4>التخصصات الطبية</h4>
        <?php if(!empty($specialties) && $specialties->isNotEmpty()): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e($specialty->name); ?>

                        <a href="<?php echo e(route('specialties.doctors', $specialty->id)); ?>" class="btn btn-sm btn-primary">عرض الأطباء</a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info">لا توجد تخصصات متاحة.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/dashboard.blade.php ENDPATH**/ ?>
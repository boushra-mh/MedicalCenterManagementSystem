

<?php $__env->startSection('title', __('messages.dashboard_title', [], app()->getLocale())); ?>
<?php $__env->startSection('styles'); ?>
<style>
    .cursor-pointer {
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .cursor-pointer:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        text-decoration: none !important;
    }
    .card {
        color: inherit;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4"><?php echo e(__('messages.dashboard_title')); ?></h2>

    <!-- بطاقات الإحصائيات -->
    <div class="row text-center">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white cursor-pointer">
                <div class="card-body">
                    <h5><?php echo e(__('messages.all_appointments')); ?></h5>
                    <h3><?php echo e($stats['total']); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white cursor-pointer">
                <div class="card-body">
                    <h5><?php echo e(__('messages.confirmed_appointments')); ?></h5>
                    <h3><?php echo e($stats['confirmed']); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white cursor-pointer">
                <div class="card-body">
                    <h5><?php echo e(__('messages.canceled_appointments')); ?></h5>
                    <h3><?php echo e($stats['canceled']); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark cursor-pointer">
                <div class="card-body">
                    <h5><?php echo e(__('messages.pending_appointments')); ?></h5>
                    <h3><?php echo e($stats['pending']); ?></h3>
                </div>
            </div>
        </div>
    </div>



    <!-- جدول مواعيد اليوم -->
    <div class="mt-5">
        <h4><?php echo e(__('messages.today_appointments')); ?></h4>
        <?php if($appointmentsToday->isEmpty()): ?>
            <div class="alert alert-info"><?php echo e(__('messages.no_appointments_today')); ?></div>
        <?php else: ?>
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th><?php echo e(__('messages.doctor')); ?></th>
                        <th><?php echo e(__('messages.time')); ?></th>
                        <th><?php echo e(__('messages.status')); ?></th>
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
                                    <?php echo e(__('messages.statuses.' . $status)); ?>

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
        <h4><?php echo e(__('messages.medical_specialties')); ?></h4>
        <?php if(!empty($specialties) && $specialties->isNotEmpty()): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e($specialty->name); ?>

                        <a href="<?php echo e(route('specialties.doctors', $specialty->id)); ?>" class="btn btn-sm btn-primary">
                            <?php echo e(__('messages.view_doctors')); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info"><?php echo e(__('messages.no_specialties')); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/dashboard.blade.php ENDPATH**/ ?>
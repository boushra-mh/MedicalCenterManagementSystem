

<?php $__env->startSection('title', __('messages.doctor_dashboard')); ?>

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
<div class="container mt-4">
    <h2 class="mb-4"><?php echo e(__('messages.doctor_dashboard')); ?></h2>

    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-info text-white shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6><?php echo e(__('messages.today_appointments')); ?></h6>
                    <h4><?php echo e($stats['today']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6><?php echo e(__('messages.confirmed')); ?></h6>
                    <h4><?php echo e($stats['confirmed']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6><?php echo e(__('messages.cancelled')); ?></h6>
                    <h4><?php echo e($stats['cancelled']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6><?php echo e(__('messages.pending')); ?></h6>
                    <h4><?php echo e($stats['pending']); ?></h4>
                </div>
            </div>
        </div>
    </div>

    
    <h5 class="mb-3"><?php echo e(__('messages.today_appointments')); ?></h5>
    <?php if($appointmentsToday->isEmpty()): ?>
        <div class="alert alert-info text-center"><?php echo e(__('messages.no_appointments_today')); ?></div>
    <?php else: ?>
        <table class="table table-bordered table-striped text-center align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th><?php echo e(__('messages.patient_name')); ?></th>
                    <th><?php echo e(__('messages.date')); ?></th>
                    <th><?php echo e(__('messages.time')); ?></th>
                    <th><?php echo e(__('messages.status')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $statusColors = [
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'canceled' => 'danger',
                    ];
                ?>

                <?php $__currentLoopData = $appointmentsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $statusValue = $appointment->status instanceof \BackedEnum ? $appointment->status->value : $appointment->status;
                    ?>
                    <tr>
                        <td><?php echo e($appointment->user->name ?? '—'); ?></td>
                        <td><?php echo e($appointment->date); ?></td>
                        <td><?php echo e($appointment->time); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($statusColors[$statusValue] ?? 'secondary'); ?>">
                                <?php echo e(ucfirst(__("messages.$statusValue"))); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.doctor.doctor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/dashboard.blade.php ENDPATH**/ ?>
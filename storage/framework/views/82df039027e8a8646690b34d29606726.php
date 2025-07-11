

<?php $__env->startSection('title', __('messages.appointments_list')); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2 class="mb-4"><?php echo e(__('messages.all_appointments')); ?></h2>

    <?php if($appointments->isEmpty()): ?>
        <div class="alert alert-info text-center"><?php echo e(__('messages.no_appointments')); ?></div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><?php echo e(__('messages.patient')); ?></th>
                    <th><?php echo e(__('messages.doctor')); ?></th>
                    <th><?php echo e(__('messages.date')); ?></th>
                    <th><?php echo e(__('messages.time')); ?></th>
                    <th><?php echo e(__('messages.status')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($appointment->user?->name ?? '-'); ?></td>
                        <td><?php echo e($appointment->doctor?->name ?? '-'); ?></td>
                        <td><?php echo e($appointment->date); ?></td>
                        <td><?php echo e($appointment->time); ?></td>
                       <td><?php echo e(__('messages.' . $appointment->status->value)); ?></td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <?php echo e($appointments->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>
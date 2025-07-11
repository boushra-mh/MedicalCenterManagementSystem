

<?php $__env->startSection('title', __('messages.doctors_in_specialty', ['specialty' => $specialty->name])); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-3"><?php echo e(__('messages.doctors_in_specialty', ['specialty' => $specialty->name])); ?></h2>

    <?php if($specialty->doctors->isEmpty()): ?>
        <div class="alert alert-warning"><?php echo e(__('messages.no_doctors_in_specialty')); ?></div>
    <?php else: ?>
        <div class="row">
            <?php $__currentLoopData = $specialty->doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5><?php echo e($doctor->name); ?></h5>
                            <p><strong><?php echo e(__('messages.email')); ?>:</strong> <?php echo e($doctor->email); ?></p>
                            <p><strong><?php echo e(__('messages.status')); ?>:</strong> 
                                <span class="badge bg-<?php echo e($doctor->status->value === 'active' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($doctor->status->label()); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/doctors/doctors_by_specialty.blade.php ENDPATH**/ ?>
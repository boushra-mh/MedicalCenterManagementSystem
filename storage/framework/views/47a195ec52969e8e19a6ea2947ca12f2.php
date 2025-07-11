

<?php $__env->startSection('title', __('messages.doctors_list')); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2><?php echo e(__('messages.doctors_list')); ?></h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('admin.doctors.create')); ?>" class="btn btn-primary mb-3"><?php echo e(__('messages.add_new_doctor')); ?></a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo e(__('messages.name')); ?></th>
                <th><?php echo e(__('messages.email')); ?></th>
                <th><?php echo e(__('messages.specialties')); ?></th>
                <th><?php echo e(__('messages.status')); ?></th>
                <th><?php echo e(__('messages.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($doctor->name); ?></td>
                    <td><?php echo e($doctor->email); ?></td>
                    <td>
                        <?php $__currentLoopData = $doctor->specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-info text-dark"><?php echo e($specialty->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <form action="<?php echo e(route('admin.doctors.toggleStatus', $doctor->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit"
                                class="badge border-0 <?php echo e($doctor->status == \App\Enums\StatusEnum::Active->value ? 'bg-success' : 'bg-secondary'); ?>"
                                style="cursor: pointer;"
                            >
                                <?php echo e($doctor->status == \App\Enums\StatusEnum::Active->value ? __('messages.active') : __('messages.inactive')); ?>

                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.doctors.edit', $doctor->id)); ?>" class="btn btn-sm btn-warning"><?php echo e(__('messages.edit')); ?></a>

                        <form action="<?php echo e(route('admin.doctors.destroy', $doctor->id)); ?>" method="POST" style="display:inline-block" onsubmit="return confirm('<?php echo e(__('messages.confirm_delete_doctor')); ?>');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger" type="submit"><?php echo e(__('messages.delete')); ?></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center"><?php echo e(__('messages.no_doctors_yet')); ?></td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
     
<?php echo $__env->make('layouts.admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/doctors/index.blade.php ENDPATH**/ ?>
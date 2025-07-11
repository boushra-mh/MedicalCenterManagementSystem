

<?php $__env->startSection('title', __('messages.specialties')); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2><?php echo e(__('messages.specialties')); ?></h2>

    <?php if(session('success')): ?> 
        <div class="alert alert-success"><?php echo e(session('success')); ?></div> 
    <?php endif; ?>

    <a href="<?php echo e(route('admin.specialties.create')); ?>" class="btn btn-primary mb-3">
        <?php echo e(__('messages.add_new_specialty')); ?>

    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('messages.name_en')); ?></th>
                <th><?php echo e(__('messages.name_ar')); ?></th>
                <th><?php echo e(__('messages.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($specialty->getTranslation('name', 'en')); ?></td>
                    <td><?php echo e($specialty->getTranslation('name', 'ar')); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.specialties.edit', $specialty->id)); ?>" class="btn btn-sm btn-warning">
                            <?php echo e(__('messages.edit')); ?>

                        </a>
                        <form action="<?php echo e(route('admin.specialties.destroy', $specialty->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                            <?php echo csrf_field(); ?> 
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger"><?php echo e(__('messages.delete')); ?></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        <?php echo e($specialties->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/specialty/index.blade.php ENDPATH**/ ?>
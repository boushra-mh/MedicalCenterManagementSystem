
<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Specialties</h2>
    <?php if(session('success')): ?> <div class="alert alert-success"><?php echo e(session('success')); ?></div> <?php endif; ?>

    <a href="<?php echo e(route('admin.specialties.create')); ?>" class="btn btn-primary mb-3">+ Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name (EN)</th>
                <th>Name (AR)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($specialty->getTranslation('name', 'en')); ?></td>
                    <td><?php echo e($specialty->getTranslation('name', 'ar')); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.specialties.edit', $specialty->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?php echo e(route('admin.specialties.destroy', $specialty->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($specialties->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/specialty/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Edit Specialty'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Edit Specialty</h2>

    <form action="<?php echo e(route('admin.specialties.update', $specialty->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="name_en" class="form-label">Name (English)</label>
            <input type="text" name="name_en" class="form-control" value="<?php echo e(old('name_en', $specialty->getTranslation('name', 'en'))); ?>">
            <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">Name (Arabic)</label>
            <input type="text" name="name_ar" class="form-control" value="<?php echo e(old('name_ar', $specialty->getTranslation('name', 'ar'))); ?>">
            <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo e(route('admin.specialties.index')); ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/specialty/edit.blade.php ENDPATH**/ ?>
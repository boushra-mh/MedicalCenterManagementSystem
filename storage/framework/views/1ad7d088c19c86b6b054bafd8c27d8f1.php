

<?php $__env->startSection('title', 'إضافة طبيب جديد'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>إضافة طبيب جديد</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.doctors.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="specialties" class="form-label">التخصصات</label>
            <select name="specialties[]" id="specialties" class="form-select" multiple>
                <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($specialty->id); ?>" <?php echo e((collect(old('specialties'))->contains($specialty->id)) ? 'selected' : ''); ?>>
                        <?php echo e($specialty->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <small class="text-muted">يمكنك اختيار أكثر من تخصص بالضغط على Ctrl أو Cmd</small>
        </div>

        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="<?php echo e(route('admin.doctors.index')); ?>" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/doctors/create.blade.php ENDPATH**/ ?>
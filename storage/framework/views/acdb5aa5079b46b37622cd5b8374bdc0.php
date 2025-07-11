

<?php $__env->startSection('title',__('messages.patient_login')); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4> <?php echo e(__('messages.patient_login')); ?> </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('user.login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label"><?php echo e(__('messages.email')); ?> </label>
                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo e(__('messages.password')); ?> </label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
                        <?php endif; ?>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"><?php echo e(__('messages.patient_login')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/auth/login.blade.php ENDPATH**/ ?>
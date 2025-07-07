<!DOCTYPE html>
<html>
<head><title>User Register</title></head>
<body>
    <h2>User Register</h2>

    <form method="POST" action="<?php echo e(route('user.register')); ?>">
        <?php echo csrf_field(); ?>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Register</button>
    </form>

    <?php if($errors->any()): ?>
    <div style="color: red;">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/auth/register.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html>
<head><title>Doctor Login</title></head>
<body>
    <h2>Doctor Login</h2>

    <form method="POST" action="<?php echo e(route('doctor.login')); ?>">
        <?php echo csrf_field(); ?>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>

    <?php if($errors->any()): ?>
    <div style="color: red;"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>
</body>
</html>
    <?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/auth/login.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html>
<head><title>User Login</title></head>
<body>
    <h2>User Login</h2>

    <form method="POST" action="<?php echo e(route('user.login')); ?>">
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
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/auth/login.blade.php ENDPATH**/ ?>
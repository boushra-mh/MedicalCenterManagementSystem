<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST" action="<?php echo e(url('admin/login')); ?>">
        <?php echo csrf_field(); ?>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required />
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit">Login</button>
    </form>
    <?php if($errors->any()): ?>
        <div style="color:red;"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>
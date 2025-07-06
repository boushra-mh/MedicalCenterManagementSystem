<!DOCTYPE html>
<html>
<head><title>Doctor Dashboard</title></head>
<body>
    <h1>Welcome, Dr. <?php echo e(auth()->guard('doctor_web')->user()->name); ?></h1>

    <form method="POST" action="<?php echo e(route('doctor.logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit">Logout</button>
    </form>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard.blade.php ENDPATH**/ ?>
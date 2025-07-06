<h1>Welcome Admin</h1>
<form action="<?php echo e(route('admin.logout')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <button type="submit">Logout</button>
</form>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/auth/dashboard.blade.php ENDPATH**/ ?>
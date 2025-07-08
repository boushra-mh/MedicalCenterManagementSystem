<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'لوحة الطبيب'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('doctor.dashboard')); ?>">Doctor Panel</a>
        </div>
    </nav>

    
    <div class="d-flex">
        <?php echo $__env->make('layouts.partials.doctor-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="flex-grow-1 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/doctor/doctor.blade.php ENDPATH**/ ?>
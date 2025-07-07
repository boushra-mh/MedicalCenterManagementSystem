<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'لوحة المريض'); ?></title>
    
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

    <div class="d-flex">
        <!-- الشريط الجانبي -->
        <div class="sidebar p-3">
            <h5 class="text-white mb-4">👨‍⚕️ المريض</h5>
            <a href="<?php echo e(route('user.dashboard')); ?>">🏠 لوحة التحكم</a>
            <a href="<?php echo e(route('user.appointments.index')); ?>">📋 مواعيدي</a>
            <a href="<?php echo e(route('user.appointments.create')); ?>">➕ حجز موعد</a>
            <a href="<?php echo e(route('user.logout')); ?>"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               🚪 تسجيل الخروج
            </a>
            <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </div>

        <!-- محتوى الصفحة -->
        <div class="flex-grow-1 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/user.blade.php ENDPATH**/ ?>
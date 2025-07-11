<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', __('messages.admin_panel')); ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap<?php echo e(app()->getLocale() === 'ar' ? '.rtl' : ''); ?>.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .cursor-pointer {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cursor-pointer:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            text-decoration: none !important;
        }
        a > .card {
            color: inherit;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('messages.admin_panel')); ?></a>

            
            <div class="dropdown ms-auto">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    🌐 <?php echo e(app()->getLocale() === 'ar' ? 'العربية' : 'English'); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?php echo e(route('lang.switch', 'ar')); ?>">العربية</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('lang.switch', 'en')); ?>">English</a></li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="d-flex">
        
        <?php echo $__env->make('layouts.partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        
        <div class="flex-grow-1 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/admin/admin.blade.php ENDPATH**/ ?>
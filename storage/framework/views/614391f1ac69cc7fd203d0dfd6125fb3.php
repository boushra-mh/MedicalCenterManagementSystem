<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', __('messages.patient_panel')); ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap<?php echo e(app()->getLocale() === 'ar' ? '.rtl' : ''); ?>.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            width: 220px;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: #495057;
            text-decoration: none;
        }
        .content-area {
            flex-grow: 1;
            padding: 20px;
        }
        /* Adjust margin for RTL and LTR */
        [dir="rtl"] .sidebar {
            border-left: 1px solid #495057;
        }
        [dir="ltr"] .sidebar {
            border-right: 1px solid #495057;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('user.dashboard')); ?>">👨‍⚕️ <?php echo e(__('messages.patient_panel')); ?></a>

            
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
        <div class="sidebar p-3">
            <h5 class="text-white mb-4">👨‍⚕️ <?php echo e(__('messages.patient')); ?></h5>
            <a href="<?php echo e(route('user.dashboard')); ?>">🏠 <?php echo e(__('messages.dashboard')); ?></a>
            <a href="<?php echo e(route('user.appointments.index')); ?>">📋 <?php echo e(__('messages.my_appointments')); ?></a>
            <a href="<?php echo e(route('user.appointments.create')); ?>">➕ <?php echo e(__('messages.book_appointment')); ?></a>
               <!-- 📧 سجل الإيميلات -->
  
            <a class="nav-link <?php echo e(request()->routeIs('emails') ? 'active' : ''); ?>" href="<?php echo e(route('emails')); ?>">
                📧 <?php echo e(__('messages.email_logs')); ?>

            </a>
        
            <a href="<?php echo e(route('user.logout')); ?>"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               🚪 <?php echo e(__('messages.logout')); ?>

            </a>
            <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </div>

        <main class="content-area">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/user/user.blade.php ENDPATH**/ ?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow" style="width: 250px; min-height: 100vh;">
    <a href="<?php echo e(route('doctor.dashboard')); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <span class="fs-4 fw-bold text-primary">لوحة الطبيب</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="<?php echo e(route('doctor.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('doctor.dashboard') ? 'active' : 'text-dark'); ?>">
                🏠 الرئيسية
            </a>
        </li>
        <li>
 <?php
    $pendingCount = \App\Models\Appointment::byDoctor(auth('doctor_web')->id())->pending()->count();
?>
<a href="<?php echo e(route('doctor.appointments.index')); ?>" class="nav-link <?php echo e(request()->routeIs('doctor.appointments.index') ? 'active' : 'text-dark'); ?>">
    📅 جميع المواعيد
    <?php if($pendingCount > 0): ?>
        <span class="badge bg-warning text-dark ms-2"><?php echo e($pendingCount); ?></span>
    <?php endif; ?>
</a>


        </li>
          <li class="nav-item mb-2">
        <a class="nav-link <?php echo e(request()->routeIs('emails') ? 'active' : ''); ?>" href="<?php echo e(route('emails')); ?>">
            📧 سجل الإيميلات
        </a>
    </li>
        <li>
            <a href="<?php echo e(route('doctor.profile')); ?>" class="nav-link <?php echo e(request()->routeIs('doctor.profile') ? 'active' : 'text-dark'); ?>">
                👤 الملف الشخصي
            </a>
        </li>
        <li>
            <form action="<?php echo e(route('doctor.logout')); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button class="nav-link text-danger border-0 bg-transparent">🚪 تسجيل الخروج</button>
            </form>
        </li>
        
    </ul>
</div>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/partials/doctor-sidebar.blade.php ENDPATH**/ ?>
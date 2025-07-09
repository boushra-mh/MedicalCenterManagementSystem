<div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow" style="width: 250px; min-height: 100vh;">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <span class="fs-4 fw-bold text-primary">لوحة الإدارة</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        <!-- 🏠 الرئيسية -->
        <li class="nav-item">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : 'text-dark'); ?>">
                🏠 الرئيسية
            </a>
        </li>

        <!-- 👨‍⚕️ الأطباء -->
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#doctorsMenu" role="button" aria-expanded="false" aria-controls="doctorsMenu">
                👨‍⚕️ الأطباء
            </a>
            <div class="collapse <?php echo e(request()->is('admin/doctors*') ? 'show' : ''); ?>" id="doctorsMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal small ps-3">
                    <li><a href="<?php echo e(route('admin.doctors.index')); ?>" class="nav-link text-dark">📋 قائمة الأطباء</a></li>
                    <li><a href="<?php echo e(route('admin.doctors.create')); ?>" class="nav-link text-dark">➕ إضافة طبيب</a></li>
                </ul>
            </div>
        </li>

        <!-- 👥 المرضى -->
        <li>
            <a href="<?php echo e(route('admin.patients.index')); ?>" class="nav-link <?php echo e(request()->is('admin/patients*') ? 'active' : 'text-dark'); ?>">
                👥 المرضى
            </a>
        </li>

        <!-- 🧬 التخصصات -->
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#specialtiesMenu" role="button" aria-expanded="false" aria-controls="specialtiesMenu">
                🧬 التخصصات
            </a>
            <div class="collapse <?php echo e(request()->is('admin/specialties*') ? 'show' : ''); ?>" id="specialtiesMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal small ps-3">
                    <li><a href="<?php echo e(route('admin.specialties.index')); ?>" class="nav-link text-dark">📋 قائمة التخصصات</a></li>
                    <li><a href="<?php echo e(route('admin.specialties.create')); ?>" class="nav-link text-dark">➕ إضافة تخصص</a></li>
                </ul>
            </div>
        </li>

        <!-- 📅 المواعيد -->
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#appointmentsMenu" role="button" aria-expanded="false" aria-controls="appointmentsMenu">
                📅 المواعيد
            </a>
            <div class="collapse <?php echo e(request()->is('admin/appointments*') ? 'show' : ''); ?>" id="appointmentsMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal small ps-3">
                    <li><a href="<?php echo e(route('admin.appointments.index')); ?>" class="nav-link text-dark">📋 قائمة المواعيد</a></li>
                    <li><a href="<?php echo e(route('admin.appointments.trashed')); ?>" class="nav-link text-dark">🗑️ المحذوفة</a></li>
                </ul>
            </div>
        </li>

    </ul>

    <hr>

    <!-- ⚙️ القائمة السفلية -->
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>⚙️ المدير</strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#">الإعدادات</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="dropdown-item">🚪 تسجيل الخروج</button>
                </form>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/partials/admin-sidebar.blade.php ENDPATH**/ ?>
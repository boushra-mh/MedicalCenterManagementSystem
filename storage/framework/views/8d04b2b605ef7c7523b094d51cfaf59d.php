<div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow" style="width: 250px; min-height: 100vh;">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="d-flex align-items-center mb-3 text-decoration-none">
        <span class="fs-4 fw-bold text-primary"><?php echo e(__('messages.admin_panel')); ?></span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        
        <li class="nav-item">
            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : 'text-dark'); ?>">
                🏠 <?php echo e(__('messages.dashboard')); ?>

            </a>
        </li>

        
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#doctorsMenu" role="button"
               aria-expanded="<?php echo e(request()->is('admin/doctors*') ? 'true' : 'false'); ?>" aria-controls="doctorsMenu">
                👨‍⚕️ <?php echo e(__('messages.doctors')); ?>

            </a>
            <div class="collapse <?php echo e(request()->is('admin/doctors*') ? 'show' : ''); ?>" id="doctorsMenu">
                <ul class="list-unstyled small ps-3">
                    <li><a href="<?php echo e(route('admin.doctors.index')); ?>" class="nav-link text-dark">📋 <?php echo e(__('messages.doctor_list')); ?></a></li>
                    <li><a href="<?php echo e(route('admin.doctors.create')); ?>" class="nav-link text-dark">➕ <?php echo e(__('messages.add_doctor')); ?></a></li>
                </ul>
            </div>
        </li>

        
        <li>
            <a href="<?php echo e(route('admin.patients.index')); ?>"
               class="nav-link <?php echo e(request()->is('admin/patients*') ? 'active' : 'text-dark'); ?>">
                👥 <?php echo e(__('messages.patients')); ?>

            </a>
        </li>

        
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#specialtiesMenu" role="button"
               aria-expanded="<?php echo e(request()->is('admin/specialties*') ? 'true' : 'false'); ?>" aria-controls="specialtiesMenu">
                🧬 <?php echo e(__('messages.specialties')); ?>

            </a>
            <div class="collapse <?php echo e(request()->is('admin/specialties*') ? 'show' : ''); ?>" id="specialtiesMenu">
                <ul class="list-unstyled small ps-3">
                    <li><a href="<?php echo e(route('admin.specialties.index')); ?>" class="nav-link text-dark">📋 <?php echo e(__('messages.specialty_list')); ?></a></li>
                    <li><a href="<?php echo e(route('admin.specialties.create')); ?>" class="nav-link text-dark">➕ <?php echo e(__('messages.add_specialty')); ?></a></li>
                </ul>
            </div>
        </li>

        
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#appointmentsMenu" role="button"
               aria-expanded="<?php echo e(request()->is('admin/appointments*') ? 'true' : 'false'); ?>" aria-controls="appointmentsMenu">
                📅 <?php echo e(__('messages.appointments')); ?>

            </a>
            <div class="collapse <?php echo e(request()->is('admin/appointments*') ? 'show' : ''); ?>" id="appointmentsMenu">
                <ul class="list-unstyled small ps-3">
                    <li><a href="<?php echo e(route('admin.appointments.index')); ?>" class="nav-link text-dark">📋 <?php echo e(__('messages.appointment_list')); ?></a></li>
                    <li><a href="<?php echo e(route('admin.appointments.trashed')); ?>" class="nav-link text-dark">🗑️ <?php echo e(__('messages.trashed_appointments')); ?></a></li>
                </ul>
            </div>
        </li>

        
        <li>
            <a href="<?php echo e(route('admin.email_logs')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.email_logs') ? 'active' : 'text-dark'); ?>">
                📧 <?php echo e(__('messages.email_logs')); ?>

            </a>
        </li>
    </ul>

    <hr>

    
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown" aria-expanded="false">
            <strong>⚙️ <?php echo e(__('messages.admin')); ?></strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#"><?php echo e(__('messages.settings')); ?></a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="dropdown-item">🚪 <?php echo e(__('messages.logout')); ?></button>
                </form>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/layouts/partials/admin-sidebar.blade.php ENDPATH**/ ?>
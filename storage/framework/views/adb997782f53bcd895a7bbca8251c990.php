<?php $__env->startSection('title', __('messages.my_appointments')); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* تحسين مظهر الأزرار والأيقونات */
    .action-btn {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 1.2rem;
        margin: 0 4px;
        transition: color 0.3s ease;
    }
    .action-btn.delete {
        color: #28a745; /* أخضر */
    }
    .action-btn.delete:hover {
        color: #19692c;
    }
    .action-btn.cancel {
        color: #dc3545; /* أحمر */
    }
    .action-btn.cancel:hover {
        color: #8a1c1c;
    }
    tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4"><?php echo e(__('messages.my_appointments')); ?></h2>

    
    <form method="GET" action="<?php echo e(route('user.appointments.index')); ?>" class="mb-4 row g-3 align-items-center">
        <div class="col-md-3">
            <label for="status" class="form-label"><?php echo e(__('messages.status')); ?></label>
            <select name="status" id="status" class="form-select">
                <option value=""><?php echo e(__('messages.all') ?? 'الكل'); ?></option>
                <option value="pending" <?php if(request('status') == 'pending'): echo 'selected'; endif; ?>><?php echo e(__('messages.pending')); ?></option>
                <option value="confirmed" <?php if(request('status') == 'confirmed'): echo 'selected'; endif; ?>><?php echo e(__('messages.confirmed')); ?></option>
                <option value="canceled" <?php if(request('status') == 'canceled'): echo 'selected'; endif; ?>><?php echo e(__('messages.canceled')); ?></option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="date" class="form-label"><?php echo e(__('messages.appointment_date')); ?></label>
            <input type="date" name="date" id="date" class="form-control" value="<?php echo e(request('date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="from_date" class="form-label"><?php echo e(__('messages.from_date') ?? 'من تاريخ'); ?></label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="to_date" class="form-label"><?php echo e(__('messages.to_date') ?? 'إلى تاريخ'); ?></label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="time" class="form-label"><?php echo e(__('messages.time')); ?></label>
            <input type="time" name="time" id="time" class="form-control" value="<?php echo e(request('time')); ?>">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary"><?php echo e(__('messages.filter')); ?></button>
            <a href="<?php echo e(route('user.appointments.index')); ?>" class="btn btn-secondary ms-2"><?php echo e(__('messages.reset')); ?></a>
        </div>
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($appointments->isEmpty()): ?>
        <div class="alert alert-info text-center"><?php echo e(__('messages.no_appointments')); ?></div>
    <?php else: ?>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th><?php echo e(__('messages.doctor_name')); ?></th>
                    <th><?php echo e(__('messages.appointment_date')); ?></th>
                    <th><?php echo e(__('messages.time')); ?></th>
                    <th><?php echo e(__('messages.status')); ?></th>
                    <th><?php echo e(__('messages.actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $statusColors = [
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'canceled' => 'danger',
                    ];
                ?>

                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $statusValue = $appointment->status instanceof \BackedEnum ? $appointment->status->value : $appointment->status;
                    ?>
                    <tr>
                        <td><?php echo e($appointment->doctor->name ?? '—'); ?></td>
                        <td><?php echo e($appointment->date); ?></td>
                        <td><?php echo e($appointment->time); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($statusColors[$statusValue] ?? 'secondary'); ?>">
                                <?php echo e(ucfirst(__("messages.$statusValue"))); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($statusValue === 'pending'): ?>
                                <form action="<?php echo e(route('user.appointments.destroy', $appointment->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('<?php echo e(__('messages.are_you_sure_delete')); ?>');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="action-btn delete" type="submit" title="<?php echo e(__('messages.delete')); ?>">
                                        🗑️
                                    </button>
                                </form>

                                <form action="<?php echo e(route('user.appointments.cancel', $appointment->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('<?php echo e(__('messages.are_you_sure_cancel')); ?>');">
                                    <?php echo csrf_field(); ?>
                                    <button class="action-btn cancel" type="submit" title="<?php echo e(__('messages.cancel')); ?>">
                                        ❌
                                    </button>
                                </form>
                            <?php else: ?>
                                <span>—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div>
            <?php echo e($appointments->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/appointments/index.blade.php ENDPATH**/ ?>
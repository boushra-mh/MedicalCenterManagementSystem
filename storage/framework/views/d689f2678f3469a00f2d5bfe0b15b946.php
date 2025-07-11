

<?php $__env->startSection('title', __('messages.appointments_list')); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4"><?php echo e(__('messages.appointments_list')); ?></h2>
    
    <form method="GET" action="<?php echo e(route('doctor.appointments.index')); ?>" class="mb-4 row g-3 align-items-center">
        <div class="col-md-3">
            <label for="status" class="form-label"><?php echo e(__('messages.status')); ?></label>
            <select name="status" id="status" class="form-select">
                <option value=""><?php echo e(__('messages.all')); ?></option>
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
            <label for="from_date" class="form-label"><?php echo e(__('messages.from_date')); ?></label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="to_date" class="form-label"><?php echo e(__('messages.to_date')); ?></label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="time" class="form-label"><?php echo e(__('messages.time')); ?></label>
            <input type="time" name="time" id="time" class="form-control" value="<?php echo e(request('time')); ?>">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary"><?php echo e(__('messages.filter')); ?></button>
            <a href="<?php echo e(route('doctor.appointments.index')); ?>" class="btn btn-secondary ms-2"><?php echo e(__('messages.reset')); ?></a>
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
                    <th><?php echo e(__('messages.patient_name')); ?></th>
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
                        <td><?php echo e($appointment->user->name ?? '—'); ?></td>
                        <td><?php echo e($appointment->date); ?></td>
                        <td><?php echo e($appointment->time); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($statusColors[$statusValue] ?? 'secondary'); ?>">
                                <?php echo e(ucfirst(__("messages.$statusValue"))); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($statusValue === 'pending'): ?>
                                <form action="<?php echo e(route('doctor.appointments.confirm', $appointment->id)); ?>" method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-sm btn-success" type="submit">✅ <?php echo e(__('messages.confirm')); ?></button>
                                </form>

                                <form action="<?php echo e(route('doctor.appointments.cancel', $appointment->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('<?php echo e(__('messages.confirm_cancel_appointment')); ?>');">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-sm btn-danger" type="submit">❌ <?php echo e(__('messages.cancel')); ?></button>
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

<?php echo $__env->make('layouts.doctor.doctor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/appointments.blade.php ENDPATH**/ ?>
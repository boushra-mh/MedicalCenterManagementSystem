 

<?php $__env->startSection('title', 'مواعيدي'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">مواعيدي</h2>


    
    <form method="GET" action="<?php echo e(route('user.appointments.index')); ?>" class="mb-4 row g-3 align-items-center">
        <div class="col-md-3">
            <label for="status" class="form-label">الحالة</label>
            <select name="status" id="status" class="form-select">
                <option value="">الكل</option>
                <option value="pending" <?php if(request('status') == 'pending'): echo 'selected'; endif; ?>>معلق</option>
                <option value="confirmed" <?php if(request('status') == 'confirmed'): echo 'selected'; endif; ?>>مؤكد</option>
                <option value="canceled" <?php if(request('status') == 'canceled'): echo 'selected'; endif; ?>>ملغي</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="date" class="form-label">تاريخ الموعد</label>
            <input type="date" name="date" id="date" class="form-control" value="<?php echo e(request('date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="from_date" class="form-label">من تاريخ</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="to_date" class="form-label">إلى تاريخ</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
        </div>

        <div class="col-md-3">
            <label for="time" class="form-label">الوقت</label>
            <input type="time" name="time" id="time" class="form-control" value="<?php echo e(request('time')); ?>">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">فلترة</button>
            <a href="<?php echo e(route('user.appointments.index')); ?>" class="btn btn-secondary ms-2">إعادة تعيين</a>
        </div>
    </form>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($appointments->isEmpty()): ?>
        <div class="alert alert-info text-center">لا توجد مواعيد حالياً.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>اسم الطبيب</th>
                    <th>تاريخ الموعد</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
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
                                <?php echo e(ucfirst(__($statusValue))); ?>

                            </span>
                        </td>
                          <td>
                            <?php if($statusValue === 'pending'): ?>
                                <form action="<?php echo e(route('user.appointments.destroy', $appointment->id)); ?>" method="DELETE" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-sm btn-success" type="submit"> 🗑️ حذف </button>
                                </form>

                                <form action="<?php echo e(route('user.appointments.cancel', $appointment->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من إلغاء الموعد؟');">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-sm btn-danger" type="submit">❌ إلغاء</button>
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
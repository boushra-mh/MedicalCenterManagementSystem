

<?php $__env->startSection('title', 'مواعيدي'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>مواعيدي</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('user.appointments.create')); ?>" class="btn btn-primary mb-3">حجز موعد جديد</a>

    <?php if($appointments->isEmpty()): ?>
        <div class="alert alert-info">لا توجد مواعيد حتى الآن.</div>
    <?php else: ?>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $status = $appointment->status->value;
                    ?>
                    <tr>
                        <td><?php echo e($appointment->date); ?></td>
                        <td><?php echo e($appointment->time); ?></td>
                        <td><?php echo e(__($status)); ?></td>
                    <td>
    <?php if($status === 'pending'): ?>
        <form action="<?php echo e(route('user.appointments.cancel', $appointment->id)); ?>" method="POST" onsubmit="return confirm('هل تريد إلغاء الموعد؟');" style="display:inline-block;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-warning btn-sm">إلغاء</button>
        </form>

        <form action="<?php echo e(route('user.appointments.destroy', $appointment->id)); ?>" method="POST" onsubmit="return confirm('هل تريد حذف الموعد نهائيًا؟');" style="display:inline-block; margin-right: 5px;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
        </form>
    <?php else: ?>
        -
    <?php endif; ?>
</td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($appointments->links()); ?>

    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/appointments/index.blade.php ENDPATH**/ ?>
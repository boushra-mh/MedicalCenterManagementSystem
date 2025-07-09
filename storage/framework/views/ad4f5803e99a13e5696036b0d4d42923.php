

<?php $__env->startSection('title', 'المواعيد المحذوفة مؤقتاً'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2 class="mb-4 text-danger">🗑️ قائمة المواعيد المحذوفة مؤقتاً</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($appointments->isEmpty()): ?>
        <div class="alert alert-warning text-center">لا يوجد مواعيد محذوفة حالياً.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>اسم المريض</th>
                        <th>اسم الطبيب</th>
                        <th>تاريخ الموعد</th>
                        <th>الوقت</th>
                        <th>تاريخ الحذف</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($appointment->user?->name ?? '-'); ?></td>
                            <td><?php echo e($appointment->doctor?->name ?? '-'); ?></td>
                            <td><?php echo e($appointment->date); ?></td>
                            <td><?php echo e($appointment->time); ?></td>
                            <td><?php echo e($appointment->deleted_at->format('Y-m-d H:i')); ?></td>
                            <td>
                                <form action="<?php echo e(route('admin.appointments.forceDelete', $appointment->id)); ?>" method="POST" onsubmit="return confirm('⚠️ هل أنت متأكد أنك تريد حذف هذا الموعد نهائياً؟');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger">
                                        حذف نهائي 🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/appointments/trashed.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'قائمة الأطباء'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>قائمة الأطباء</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('admin.doctors.create')); ?>" class="btn btn-primary mb-3">إضافة طبيب جديد</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>التخصصات</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($doctor->name); ?></td>
                    <td><?php echo e($doctor->email); ?></td>
                    <td>
                        <?php $__currentLoopData = $doctor->specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-info text-dark"><?php echo e($specialty->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php if($doctor->status == \App\Enums\StatusEnum::Active->value): ?>
                            <span class="badge bg-success">نشط</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">غير نشط</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.doctors.edit', $doctor->id)); ?>" class="btn btn-sm btn-warning">تعديل</a>

                        <form action="<?php echo e(route('admin.doctors.destroy', $doctor->id)); ?>" method="POST" style="display:inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطبيب؟');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center">لا يوجد أطباء حتى الآن.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/doctors/index.blade.php ENDPATH**/ ?>
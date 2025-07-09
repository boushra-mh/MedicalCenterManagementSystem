

<?php $__env->startSection('title', 'سجل الإيميلات'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">📧 سجل الرسائل الإلكترونية</h2>

    <?php if($emails->isEmpty()): ?>
        <div class="alert alert-info text-center">لا توجد رسائل حالياً.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>البريد المستلم</th>
                    <th>العنوان</th>
                    <th>المحتوى</th>
                    <th>تاريخ الإرسال</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($email->to_email); ?></td>
                        <td><?php echo e($email->subject); ?></td>
                        <td>
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#body<?php echo e($loop->index); ?>">
                                عرض المحتوى
                            </button>
                            <div id="body<?php echo e($loop->index); ?>" class="collapse mt-2 text-start">
                                <?php echo $email->body; ?>

                            </div>
                        </td>
                        <td><?php echo e($email->created_at->format('Y-m-d H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($emails->links()); ?>

    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.doctor.doctor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/user/emails.blade.php ENDPATH**/ ?>
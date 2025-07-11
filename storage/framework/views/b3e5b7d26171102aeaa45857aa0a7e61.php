

<?php $__env->startSection('title', __('messages.email_logs')); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4>📧 <?php echo e(__('messages.sent_emails_log')); ?></h4>
    <table class="table table-bordered mt-3 text-center">
        <thead class="table-dark">
            <tr>
                <th><?php echo e(__('messages.recipient')); ?></th>
                <th><?php echo e(__('messages.subject')); ?></th>
                <th><?php echo e(__('messages.date')); ?></th>
                <th><?php echo e(__('messages.view')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($email->to_email); ?></td>
                    <td><?php echo e($email->subject); ?></td>
                    <td><?php echo e($email->created_at->format('Y-m-d H:i')); ?></td>
                    <td><a href="<?php echo e(route('admin.email_logs.show', $email->id)); ?>" class="btn btn-sm btn-info"><?php echo e(__('messages.view')); ?></a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($emails->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/email_logs/index.blade.php ENDPATH**/ ?>
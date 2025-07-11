

<?php $__env->startSection('title', __('messages.email_details')); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4>📩 <?php echo e(__('messages.email_details')); ?></h4>
    <div class="mb-2"><strong><?php echo e(__('messages.to')); ?>:</strong> <?php echo e($email->to_email); ?></div>
    <div class="mb-2"><strong><?php echo e(__('messages.subject')); ?>:</strong> <?php echo e($email->subject); ?></div>
    <div class="mb-2"><strong><?php echo e(__('messages.sent_at')); ?>:</strong> <?php echo e($email->created_at->format('Y-m-d H:i')); ?></div>
    <hr>
    <div class="bg-light p-3">
        <?php echo $email->body; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/email_logs/show.blade.php ENDPATH**/ ?>
<?php
    use App\Enums\AppointementStatus;
?>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>المريض:</strong> <?php echo e($appointment->user->name ?? 'غير متوفر'); ?></p>
        <p><strong>التاريخ:</strong> <?php echo e($appointment->date); ?></p>
        <p><strong>الوقت:</strong> <?php echo e($appointment->time ?? '-'); ?></p>
        <p><strong>الحالة:</strong>
            <?php switch($appointment->status->value):
                case (AppointementStatus::CONFIRMED->value): ?>
                    مؤكد
                    <?php break; ?>
                <?php case (AppointementStatus::PENDING->value): ?>
                    قيد الانتظار
                    <?php break; ?>
                <?php case (AppointementStatus::CANCELLED->value): ?>
                    ملغي
                    <?php break; ?>
                <?php default: ?>
                    غير معروف
            <?php endswitch; ?>
        </p>
        
        <?php if(($appointment->status->value ?? $appointment->status) === AppointementStatus::PENDING->value): ?>
            <form action="<?php echo e(route('doctor.appointments.confirm', $appointment->id)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-success btn-sm">✅ موافقة</button>
            </form>

            <form action="<?php echo e(route('doctor.appointments.cancel', $appointment->id)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm">❌ رفض</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/partials/_appointment_card.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">لوحة تحكم الطبيب</h2>

    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-info text-white shadow-sm">
                <div class="card-body">
                    <h6>مواعيد اليوم</h6>
                    <h4><?php echo e($stats['today']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white shadow-sm">
                <div class="card-body">
                    <h6>المؤكدة</h6>
                    <h4><?php echo e($stats['confirmed']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white shadow-sm">
                <div class="card-body">
                    <h6>الملغاة</h6>
                    <h4><?php echo e($stats['cancelled']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark shadow-sm">
                <div class="card-body">
                    <h6>المعلّقة</h6>
                    <h4><?php echo e($stats['pending']); ?></h4>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('doctor.dashboard')); ?>" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="">كل الحالات</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>معلقة</option>
                        <option value="confirmed" <?php echo e(request('status') == 'confirmed' ? 'selected' : ''); ?>>مؤكدة</option>
                        <option value="canceled" <?php echo e(request('status') == 'canceled' ? 'selected' : ''); ?>>ملغاة</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">تاريخ الموعد</label>
                    <input type="date" name="date" class="form-control" value="<?php echo e(request('date')); ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label">الوقت</label>
                    <input type="time" name="time" class="form-control" value="<?php echo e(request('time')); ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label">من تاريخ</label>
                    <input type="date" name="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label">إلى تاريخ</label>
                    <input type="date" name="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
                </div>

                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-primary">🔍</button>
                </div>
                <div class="col-md-1 d-grid">
                    <a href="<?php echo e(route('doctor.dashboard')); ?>" class="btn btn-secondary">🔄</a>
                </div>
            </form>
        </div>
    </div>

    
    <h5 class="mb-3">مواعيد اليوم</h5>
    <?php if($appointmentsToday->isEmpty()): ?>
        <div class="alert alert-info text-center">لا توجد مواعيد لليوم.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped text-center align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>اسم المريض</th>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
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

                <?php $__currentLoopData = $appointmentsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $statusValue = $appointment->status instanceof \BackedEnum ? $appointment->status->value : $appointment->status;
                    ?>
                    <tr>
                        <td><?php echo e($appointment->user->name ?? '—'); ?></td>
                        <td><?php echo e($appointment->date); ?></td>
                        <td><?php echo e($appointment->time); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($statusColors[$statusValue] ?? 'secondary'); ?>">
                                <?php echo e(ucfirst(__($statusValue))); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.doctor.doctor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/doctor/dashboard/dashboard.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo e(__('messages.system_title')); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap<?php echo e(app()->getLocale() === 'ar' ? '.rtl' : ''); ?>.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
        /* تعديل الهيرو ليتناسب مع الكاروسيل */
        .hero {
            padding: 60px 15px;
            color: #333;
        }
        .hero-text {
            max-width: 600px;
            margin-bottom: 30px;
        }
        /* عرض صور الكاروسيل بحجم ثابت */
        .carousel-inner img {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
        .role-card img {
            width: 90px;
            height: 90px;
        }
        footer {
            background-color: #0d6efd;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
            text-align: center;
        }

        /* تعديل الكروت في قسم Roles ليكونوا بنفس الحجم */
        #roles .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 320px; /* يمكن تعديلها حسب الحاجة */
        }
        /* ضبط الصور داخل الكارد */
        #roles .card img {
            width: 96px;
            height: 96px;
            object-fit: contain;
            margin-bottom: 15px;
            margin-left: auto;
            margin-right: auto;
        }
        /* جعل زر الدخول بعرض كامل في الكارد */
        #roles .card a.btn {
            align-self: center;
            width: 100%;
        }
        /* تساوي ارتفاع الأعمدة */
        #roles .row > [class*='col-'] {
            display: flex;
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold text-primary" href="#"><?php echo e(__('messages.system_title')); ?></a>

        
        <a href="<?php echo e(route('lang.switch', ['locale' => app()->getLocale() === 'ar' ? 'en' : 'ar'])); ?>" class="btn btn-sm btn-outline-primary">
            🌐 <?php echo e(app()->getLocale() === 'ar' ? 'English' : 'العربية'); ?>

        </a>
    </div>
</nav>


<section class="hero container d-flex flex-wrap justify-content-center align-items-center gap-5">
    <div class="hero-text text-center text-md-start">
        <h1 class="fw-bold mb-3"><?php echo e(__('messages.hero_title')); ?></h1>
        <p class="lead mb-4"><?php echo e(__('messages.hero_subtitle')); ?></p>
        <a href="#roles" class="btn btn-primary btn-lg fw-bold"><?php echo e(__('messages.get_started')); ?></a>
    </div>

    <div id="heroCarousel" class="carousel slide col-12 col-md-6 col-lg-5" data-bs-ride="carousel">
        <div class="carousel-inner rounded-4 shadow-sm">
            <div class="carousel-item active">
                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/59/stethoscope-1296801_1280.png" alt="<?php echo e(__('messages.medical_image_alt')); ?>" loading="lazy" />
            </div>
            <div class="carousel-item">
                <img src="https://cdn.pixabay.com/photo/2017/02/01/22/02/medical-2031035_1280.jpg" alt="Medical Image 2" loading="lazy" />
            </div>
            <div class="carousel-item">
                <img src="https://cdn.pixabay.com/photo/2015/05/31/12/14/doctor-791351_1280.jpg" alt="Medical Image 3" loading="lazy" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(__('messages.previous')); ?></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(__('messages.next')); ?></span>
        </button>
    </div>
</section>


<section class="features py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5"><?php echo e(__('messages.features')); ?></h2>
        <div class="row text-center g-4">

            <div class="col-md-4">
                <i class="bi bi-calendar-check feature-icon"></i>
                <h5 class="mt-3"><?php echo e(__('messages.feature_appointments')); ?></h5>
                <p><?php echo e(__('messages.feature_appointments_desc')); ?></p>
            </div>

            <div class="col-md-4">
                <i class="bi bi-person-badge-fill feature-icon"></i>
                <h5 class="mt-3"><?php echo e(__('messages.feature_doctors')); ?></h5>
                <p><?php echo e(__('messages.feature_doctors_desc')); ?></p>
            </div>

            <div class="col-md-4">
                <i class="bi bi-envelope-paper-fill feature-icon"></i>
                <h5 class="mt-3"><?php echo e(__('messages.feature_emails')); ?></h5>
                <p><?php echo e(__('messages.feature_emails_desc')); ?></p>
            </div>

            <div class="col-md-4">
                <i class="bi bi-shield-lock feature-icon"></i>
                <h5 class="mt-3"><?php echo e(__('messages.feature_roles')); ?></h5>
                <p><?php echo e(__('messages.feature_roles_desc')); ?></p>
            </div>

            <div class="col-md-4">
                <i class="bi bi-translate feature-icon"></i>
                <h5 class="mt-3"><?php echo e(__('messages.feature_lang')); ?></h5>
                <p><?php echo e(__('messages.feature_lang_desc')); ?></p>
            </div>

        </div>
    </div>
</section>


<section id="roles" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5"><?php echo e(__('messages.login_by_role')); ?></h2>
        <div class="row text-center justify-content-center g-4">

            <div class="col-md-4 d-flex">
                <div class="card p-4 shadow-sm w-100">
                    <img src="https://img.icons8.com/color/96/admin-settings-male.png" alt="Admin" class="mb-3 mx-auto" />
                    <h5><?php echo e(__('messages.admin')); ?></h5>
                    <a href="<?php echo e(route('admin.login')); ?>" class="btn btn-danger mt-3"><?php echo e(__('messages.admin_login')); ?></a>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="card p-4 shadow-sm w-100">
                    <img src="https://img.icons8.com/color/96/doctor-male.png" alt="Doctor" class="mb-3 mx-auto" />
                    <h5><?php echo e(__('messages.doctor')); ?></h5>
                    <a href="<?php echo e(route('doctor.login')); ?>" class="btn btn-primary mt-3"><?php echo e(__('messages.doctor_login')); ?></a>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="card p-4 shadow-sm w-100">
                    <img src="https://img.icons8.com/color/96/patient-oxygen-mask.png" alt="Patient" class="mb-3 mx-auto" />
                    <h5><?php echo e(__('messages.patient')); ?></h5>
                    <a href="<?php echo e(route('user.login')); ?>" class="btn btn-success mt-3"><?php echo e(__('messages.patient_login')); ?></a>
                    <p class="mt-2"><a href="<?php echo e(route('user.register')); ?>"><?php echo e(__('messages.or_register')); ?></a></p>
                </div>
            </div>

        </div>
    </div>
</section>


<footer>
    <div class="container">
        <p>© <?php echo e(date('Y')); ?> <?php echo e(__('messages.system_title')); ?> - <?php echo e(__('messages.copyright')); ?></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/welcome.blade.php ENDPATH**/ ?>
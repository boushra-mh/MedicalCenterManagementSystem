<div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow" style="width: 250px; min-height: 100vh;">
    <a href="{{ route('doctor.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <span class="fs-4 fw-bold text-primary">لوحة الطبيب</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="{{ route('doctor.dashboard') }}" class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : 'text-dark' }}">
                🏠 الرئيسية
            </a>
        </li>
        <li>
 @php
    $pendingCount = \App\Models\Appointment::byDoctor(auth('doctor_web')->id())->pending()->count();
@endphp
<a href="{{ route('doctor.appointments.index') }}" class="nav-link {{ request()->routeIs('doctor.appointments.index') ? 'active' : 'text-dark' }}">
    📅 جميع المواعيد
    @if($pendingCount > 0)
        <span class="badge bg-warning text-dark ms-2">{{ $pendingCount }}</span>
    @endif
</a>


        </li>
        <li>
            <a href="{{ route('doctor.profile') }}" class="nav-link {{ request()->routeIs('doctor.profile') ? 'active' : 'text-dark' }}">
                👤 الملف الشخصي
            </a>
        </li>
        <li>
            <form action="{{ route('doctor.logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="nav-link text-danger border-0 bg-transparent">🚪 تسجيل الخروج</button>
            </form>
        </li>
    </ul>
</div>

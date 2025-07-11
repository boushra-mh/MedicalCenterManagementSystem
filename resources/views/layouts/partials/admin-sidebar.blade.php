<div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow" style="width: 250px; min-height: 100vh;">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 text-decoration-none">
        <span class="fs-4 fw-bold text-primary">{{ __('messages.admin_panel') }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        {{-- 🏠 الرئيسية --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-dark' }}">
                🏠 {{ __('messages.dashboard') }}
            </a>
        </li>

        {{-- 👨‍⚕️ الأطباء --}}
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#doctorsMenu" role="button"
               aria-expanded="{{ request()->is('admin/doctors*') ? 'true' : 'false' }}" aria-controls="doctorsMenu">
                👨‍⚕️ {{ __('messages.doctors') }}
            </a>
            <div class="collapse {{ request()->is('admin/doctors*') ? 'show' : '' }}" id="doctorsMenu">
                <ul class="list-unstyled small ps-3">
                    <li><a href="{{ route('admin.doctors.index') }}" class="nav-link text-dark">📋 {{ __('messages.doctor_list') }}</a></li>
                    <li><a href="{{ route('admin.doctors.create') }}" class="nav-link text-dark">➕ {{ __('messages.add_doctor') }}</a></li>
                </ul>
            </div>
        </li>

        {{-- 👥 المرضى --}}
        <li>
            <a href="{{ route('admin.patients.index') }}"
               class="nav-link {{ request()->is('admin/patients*') ? 'active' : 'text-dark' }}">
                👥 {{ __('messages.patients') }}
            </a>
        </li>

        {{-- 🧬 التخصصات --}}
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#specialtiesMenu" role="button"
               aria-expanded="{{ request()->is('admin/specialties*') ? 'true' : 'false' }}" aria-controls="specialtiesMenu">
                🧬 {{ __('messages.specialties') }}
            </a>
            <div class="collapse {{ request()->is('admin/specialties*') ? 'show' : '' }}" id="specialtiesMenu">
                <ul class="list-unstyled small ps-3">
                    <li><a href="{{ route('admin.specialties.index') }}" class="nav-link text-dark">📋 {{ __('messages.specialty_list') }}</a></li>
                    <li><a href="{{ route('admin.specialties.create') }}" class="nav-link text-dark">➕ {{ __('messages.add_specialty') }}</a></li>
                </ul>
            </div>
        </li>

        {{-- 📅 المواعيد --}}
        <li>
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#appointmentsMenu" role="button"
               aria-expanded="{{ request()->is('admin/appointments*') ? 'true' : 'false' }}" aria-controls="appointmentsMenu">
                📅 {{ __('messages.appointments') }}
            </a>
            <div class="collapse {{ request()->is('admin/appointments*') ? 'show' : '' }}" id="appointmentsMenu">
                <ul class="list-unstyled small ps-3">
                    <li><a href="{{ route('admin.appointments.index') }}" class="nav-link text-dark">📋 {{ __('messages.appointment_list') }}</a></li>
                    <li><a href="{{ route('admin.appointments.trashed') }}" class="nav-link text-dark">🗑️ {{ __('messages.trashed_appointments') }}</a></li>
                </ul>
            </div>
        </li>

        {{-- 📧 الإيميلات --}}
        <li>
            <a href="{{ route('admin.email_logs') }}"
               class="nav-link {{ request()->routeIs('admin.email_logs') ? 'active' : 'text-dark' }}">
                📧 {{ __('messages.email_logs') }}
            </a>
        </li>
    </ul>

    <hr>

    {{-- ⚙️ القائمة السفلية --}}
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown" aria-expanded="false">
            <strong>⚙️ {{ __('messages.admin') }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#">{{ __('messages.settings') }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item">🚪 {{ __('messages.logout') }}</button>
                </form>
            </li>
        </ul>
    </div>
</div>

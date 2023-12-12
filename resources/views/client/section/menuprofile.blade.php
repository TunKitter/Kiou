<div class="settings-widget account-settings">
    <div class="settings-menu">
        <h3>ACCOUNT SETTINGS</h3>
        <ul>
            <li class="nav-item active">
                <a href="{{route('profile')}}" class="nav-link">
                    <i class="feather-settings"></i> Edit Profile
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{route('mycourses')}}" class="nav-link">
                    <i class="feather-book"></i> My Courses
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('table-category') }}" class="nav-link">
                    <i class="feather-user"></i> User Chart
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('profile-password', $user->id)}}" class="nav-link">
                    <i class="feather-lock"></i> Password
                </a>
            </li>
        </ul>
    </div>
</div>
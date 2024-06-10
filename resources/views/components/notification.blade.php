<li class="nav-item {{ active([route('dashboard.product-notification.index'), route('dashboard.product-notification.index'). '/*']) }}">
    <a href="{{ route('dashboard.product-notification.index') }}">
        <i class="fa fa-bell"></i>
        <span class="menu-title" data-i18n="">
            @lang('admin.notification_available.title')
        </span>
        @if ($count !== 0)<span class="badge badge-pill badge-primary">{{ $count }}</span>@endif
    </a>
</li>

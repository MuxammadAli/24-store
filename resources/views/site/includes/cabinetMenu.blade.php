<ul class="cabinet-nav">
    <li class="{{ active([route('profile')]) }}">
        <a href="{{ route('profile') }}">
            <img src="/vendor/site/img/fa-solid_user-alt.svg" alt=""> @lang('app.profile.personal_data')
        </a>
    </li>
    <li class="{{ active([route('profile.orders'), route('profile.orders').'*']) }}">
        <a href="{{ route('profile.orders') }}">
            <img src="/vendor/site/img/my-orders.svg" alt=""> @lang('app.profile.orders.title')
        </a>
    </li>
    <li class="{{ active([route('favorites'), route('favorites').'*']) }}">
        <a href="{{ route('favorites') }}">
            <img src="/vendor/site/img/favs.svg" alt=""> @lang('app.profile.favorites.title')
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}">
            <img src="/vendor/site/img/log-out.svg" alt=""> @lang('app.profile.logout')
        </a>
    </li>
</ul>

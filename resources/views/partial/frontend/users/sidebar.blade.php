<div class="wn__sidebar">
    <aside class="widget recent_widget">
        <ul>
            <li class="list-group-item">
                <img src="{{ asset('assets/users/default.png') }}" alt="{{ auth()->user()->name }}">
            </li>

            <li class="list-group-item"><a href="{{ route('users.dashboard') }}">{{ __('Frontend/general.my_posts') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.post.create') }}">{{ __('Frontend/general.create_post') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.comments') }}">{{ __('Frontend/general.manage_comments') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.edit_info') }}">{{ __('Frontend/general.update_information') }}</a></li>
            <li class="list-group-item"><a href="{{ route('frontend.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Frontend/general.logout') }}</a></li>
        </ul>
    </aside>
</div>

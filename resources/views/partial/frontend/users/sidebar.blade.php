<div class="wn__sidebar">
    <aside class="widget recent_widget">
        <ul>
            <li class="list-group-item">
                @if (auth()->user()->user_image != '')
                    <img class="image_user" src="{{ asset('assets/users/' . auth()->user()->user_image) }}" alt="{{ auth()->user()->name }}">
                @else
                    <img  class="image_user" src="{{ asset('assets/users/default.png') }}" alt="{{ auth()->user()->name }}">
                @endif
            </li>
            <li class="list-group-item"><a href="{{ route('users.dashboard') }}">{{ __('Frontend/general.my_posts') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.post.create') }}">{{ __('Frontend/general.create_post') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.comments') }}">{{ __('Frontend/general.manage_comments') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.edit_info') }}">{{ __('Frontend/general.update_information') }}</a></li>
            <li class="list-group-item"><a href="{{ route('users.change_password') }}">{{ __('Frontend/general.change_password') }}</a></li>
            <li class="list-group-item"><a href="{{ route('frontend.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Frontend/general.logout') }}</a></li>
        </ul>
    </aside>
</div>

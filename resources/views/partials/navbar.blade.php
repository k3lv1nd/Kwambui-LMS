 <div class="ontop">
        <ul class="navigation menu menu-centered expanded">
            <li class="menu-text show-for-medium appname">Loan Management System</li>
            @auth
                <li><a class="dropdown-item logout" href="#"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form  id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form></li>
            @endauth
        </ul>

    </div>
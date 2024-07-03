<div class="navbar-section   ">
    <div class="section flex j-between align-center ">
        <div class="logo">
            <a href="/">
                <h2>ToDo</h2>
            </a>
        </div>
        <ul class="nav-items flex align-center gap20">
            @if(Route::has('login'))
            @auth
            <a href="logout">
                <li>Logout </li>
            </a>
            @else
            <a href="login">
                <li >Login </li>
            </a>
            @if(Route::has('register'))
            <a href="register">
                <li>Register </li>
            </a>
            @endif
            @endauth
            @endif
        </ul>
    </div>
</div>
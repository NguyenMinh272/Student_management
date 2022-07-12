
<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd; margin-bottom:30px">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @auth
            {{Auth::user()->name}}
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('faculties.index')}}">Facuty<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('subjects.index')}}">Subject<span class="sr-only">(current)</span></a>
            </li><li class="nav-item active">
                <a class="nav-link" href="{{route('students.index')}}">Student<span class="sr-only">(current)</span></a>
            </li>
        </ul>
        @endauth
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                @guest
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('students.formRegister')}}">Register<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('students.formLogin')}}">Login<span class="sr-only">(current)</span></a>
                </li>
                @endguest
                @auth
                   {{Auth::student()->full_name}}
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('students.logout')}}">Logout<span class="sr-only">(current)</span></a>
                </li>
                @endauth
            </ul>
        </form>
    </div>
</nav>

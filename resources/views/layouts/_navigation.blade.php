<nav class="navbar navbar-expand-md navbar-light bg-faded ">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Home</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= stripos(Route::current()->getName(), 'position') !== false ? 'active' : ''?>">
                <a class="nav-link" href="{{route('positions')}}">Должности <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item  <?= stripos(Route::current()->getName(), 'employee') !== false ? 'active' : ''?>">
                <a class="nav-link" href="{{route('employees')}}">Работники</a>
            </li>
        </ul>
    </div>
</nav>
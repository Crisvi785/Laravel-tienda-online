<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('/static/images/scuffers-redondo.png')}}" class="img-fluid" >
        </div>

        <div class="user">
            <span class="subtitle">Bienvenido: </span>

            <div class="name">
                {{ Auth::user()->name }} {{ Auth::user()->lastname}}
                <a class="botonn" href="{{ url('/logout')}}" data-toggle="tooltip" data-placement="top" title="Salir">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>

            <div class="email">{{ Auth::user()->email}}</div>

        </div>

    </div>

    <div class="main">
        <ul>
            <li class="lista">
                <a href="{{ url('/admin')}}" class="a"><i class="fa-solid fa-house"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ url('/admin/products')}}" class="a"><i class="fa-solid fa-boxes-stacked"></i> Productos </a>
            </li>
            <li>
                <a href="{{ url('/admin/categories/0')}}" class="a"><i class="fa-solid fa-list"></i> Categorías </a>
            </li>
            <li>
                <a href="{{ url('/admin/users')}}" class="a"><i class="fa-solid fa-users"></i> Usuarios </a>
            </li>
        </ul>
    </div>
</div>
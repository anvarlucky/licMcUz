<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/admin"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title"></li><!-- /.menu-title -->
                <li class="active">
                <a href="{{route('regions.index')}}">Вилоятлар</a>
                <a href="{{route('districts.index')}}">Туманлар</a>
                <a href="{{route('colleges.index')}}">Коллежлар</a>
                <a href="{{route('courses.index')}}">Ўқув курслари</a>
                <a href="{{route('sts.index')}}">Талабалар</a>
                <a href="{{route('users.index')}}">Фойдаланувчилар</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
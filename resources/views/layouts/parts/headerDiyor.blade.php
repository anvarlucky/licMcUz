<div class="panel-top-fixed py-2 px-5">
        <div class="panel-top-items-box">
            <img src="{{asset('/assets/diyor/images/notification-icon.svg')}}" alt="svg">
            <div type="button" class="dropdown show user-cabinet dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">{{Auth::user()->name}}</a>
                    <a class="dropdown-item" href="#">Созламалар</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item log-out" :href="{{route('logout')}}">Чиқиш</a>
                </div>
            </div>
        </div>
</div>
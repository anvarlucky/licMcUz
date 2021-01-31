@if(Auth::user())
<nav class="navbar navbar-expand-lg navbar-light bg-white px-5 d-flex align-items-center justify-content-between" style="box-shadow: 0 0 10px 5px #a5a5a58c;">
    <a class="navbar-brand Fz_brand d-flex align-items-center active" href="/" style="color: #293842;font-weight: 600;">ҚМЎК</a>
    <div class="d-lex align-items-baseline">
        <div class="btn-group">
            <button type="button" class="btn dropdown-toggle bg-white fzSize d-flex align-items-center" style="color: #a3c2d6" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <span class="round_box mr-2"><i class="lar la-user icon"></i></span>
                {{Auth::user()->name}}
            </button>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-right fzSize">
                <button class="dropdown-item px-2 py-2 d-flex align-items-center" style="min-width: 12rem;color: #818f99 " type="button">
                    <i class="lar la-user icon_drop"></i>
                    Профил                </button>
                <button class="dropdown-item px-2 py-2 d-flex align-items-center fzSize" style="min-width: 12rem;color: #818f99 " type="button">
                    <i class="las la-cog icon_drop"></i>
                    Созлама                </button>
                <a class="dropdown-item px-2 py-2 d-flex align-items-center border-top fzSize" style="min-width: 12rem;color: #818f99 " href="{{route('logout')}}">
                    <i class="las la-sign-out-alt icon_drop"></i>
                    Чиқиш</a>
            </div>
        </div>
    </div>
</nav>
@endif
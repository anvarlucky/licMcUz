@extends('layouts.mainDiyor')
@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            <a href="{{route('projects.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box all-info-box p-md-5">

                    <img src="{{asset('/assets/diyor/images/group-person-2.svg')}}" class="mb-3" alt="svg">

                    <p class="statistic-info-box-text">Arxitektura-shaharsozlik hujjatlarini ishlab chiqish faoliyatni litsenziyalash:</p>

                    <p class="statistic-info-box-num-text">{{$project_all}}</p>

                </div>
            </a>
            <a href="{{route('expertice.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box readers-info-box p-md-5">
                    <img src="{{asset('/assets/diyor/images/homework.svg')}}" class="mb-3" alt="svg">
                    <p class="statistic-info-box-text">Ekspertiza hujjatlarini ishlab chiqish faoliyatni litsenziyalash:</p>
                    <p class="statistic-info-box-num-text">{{$expertice_all}}</p>

                </div>
            </a>
            <a href="{{route('mauntaineering.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box graduates-info-box p-md-5">
                    <img src="{{asset('/assets/diyor/images/medal.svg')}}" class="mb-3" alt="svg">
                    <p class="statistic-info-box-text">Balandliklarda sanoat alpinizmi usullarida bajarish faoliyatini litsenziyalash:</p>
                    <p class="statistic-info-box-num-text">{{$mauntaineering_all}}</p>

                </div>
            </a>
{{--            <a href="{{route('defence.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box graduates-info-box p-md-5">
                    <img src="{{asset('/assets/diyor/images/medal.svg')}}" class="mb-3" alt="svg">
                    <p class="statistic-info-box-text">Mudofaa:</p>
                    <p class="statistic-info-box-num-text">{{0}}</p>

                </div>
            </a>--}}
        </div>
    </div>

    {{--<div class="container-fluid p-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{route('bridge.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box all-info-box p-md-5">

                    <img src="{{asset('/assets/diyor/images/group-person-2.svg')}}" class="mb-3" alt="svg">

                    <p class="statistic-info-box-text">Ko'prik:</p>

                    <p class="statistic-info-box-num-text">{{$bridge_all}}</p>

                </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{route('dangerous.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box readers-info-box p-md-5">
                    <img src="{{asset('/assets/diyor/images/homework.svg')}}" class="mb-3" alt="svg">
                    <p class="statistic-info-box-text">Havfi yuqori:</p>
                    <p class="statistic-info-box-num-text">{{$dangerous_all}}</p>

                </div>
                </a>
            </div>
            <div class="col-md-4">
            <a href="{{route('mauntaineering.index')}}" class="col-md-4" style="text-decoration: none">
                <div class="statistic-info-box graduates-info-box p-md-5">
                     <img src="{{asset('/assets/diyor/images/medal.svg')}}" class="mb-3" alt="svg">
                    <p class="statistic-info-box-text">Alpinizm:</p>
                    <p class="statistic-info-box-num-text">{{$mauntaineering_all}}</p>
                </div>
            </a>
        </div>
    </div>--}}
@endsection
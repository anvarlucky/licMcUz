@extends('layouts.mainDiyor')
@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-between align-items-center">
            <p class="title-list">Arxitektura-shaharsozlik hujjatlarini ishlab chiqish faoliyatni litsenziyalash ro'yhati</p>
            <form action="{{route('projects.search')}}" method="post" class="input-group  search-input col-4 mb-3">
                @csrf
                <input type="text" name="search" class="form-control focus-none border-right-0" placeholder="Qidiruv"
                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="input-group-text"><i class="fa fa-search" type="button"></i></button>
                </div>
            </form>
        </div>

        <div class="col-12 px-0 table-box">
            <div class="table-top-panel d-flex align-items-center justify-content-between px-2 py-3">
                <ul class="d-flex">
                    <li class="col px-0 mx-3 table-top-panel-items {{--active--}} {{route('projects.index') ? 'active' : ''}}">
                        <a href="{{route('projects.index')}}" class="text-decoration-none table-top-panel-items-link">Litsenziya olganlar</a>
                    </li>
                    <li class="col px-0 mx-3 table-top-panel-items">
                        <a href="{{route('export1')}}" class="text-decoration-none table-top-panel-items-link">Excelga Yuklab olish</a>
                    </li>
                </ul>


                <a href="{{route('projects.create')}}" class="btn adding-button">
                    Yangi qo'shish <i class="fa fa-plus ml-2 mt-1"></i>
                </a>
            </div>


            <div class="table-responsive">
                <table class="table table-hover" id="org_table">
                    <thead>
                    <tr>
                        <th class="lightblue-color w-2" scope="col">#</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Litsenziya raqami</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Litsenziya berilgan sana</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot nomi</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot viloyati</th>
                        <th class="darkblue-color text-center align-top">Tashkilot tumani</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot adresi</th>
                        <th class="darkblue-color text-center align-top">Qiyinchilik kategoriyasi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $key => $project)
                        <tr>
                            <th class="lightblue-color w-2 align-middle" scope="row">{{++$key}}</th>
                            <td class="darkblue-color text-center text-nowrap align-middle"><a href="{{route('projects.show',$project->id)}}">{{$project->licence_number}}</a></td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$project->licence_given_date}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$project->organization_name}}</td>
                                <td class="darkblue-color text-center text-nowrap align-middle"><a href="#">{{$project->region_id??$project->region}}</a></td>
                                <td class="darkblue-color text-center text-nowrap align-middle">{{$project->district_id??$project->district}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$project->organization_address}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$project->difficulty_category}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <br/>
{{--        {{$projects->onEachSide(1)->links()}}--}}
    </div>
@endsection



@extends('layouts.mainDiyor')
@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-between align-items-center">
            <p class="title-list">Balandliklarda sanoat alpinizmi usullarida bajarish faoliyatini litsenziyalash ro'yhati</p>
            <form action="{{route('mauntaineering.search')}}" method="post" class="input-group  search-input col-4 mb-3">
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
                    <li class="col px-0 mx-3 table-top-panel-items {{--active--}} {{route('mauntaineering.index') ? 'active' : ''}}">
                        <a href="{{route('mauntaineering.index')}}" class="text-decoration-none table-top-panel-items-link">Litsenziya olganlar</a>
                    </li>
                    <li class="col px-0 mx-3 table-top-panel-items">
                        <a href="{{route('export3')}}" class="text-decoration-none table-top-panel-items-link">Excelga Yuklab olish</a>
                    </li>
                </ul>


                <a href="{{route('mauntaineering.create')}}" class="btn adding-button">
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
                        <th class="darkblue-color text-center align-top">Faoliyat turi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mauntaineeringes as $key => $mauntaineering)
                        <tr>
                            @if($mauntaineering->status_gnk==1)
                            <th class="lightblue-color w-2 align-middle" scope="row" style="background-color: #1c7430">{{++$key}}</th>
                                @else
                                <th class="lightblue-color w-2 align-middle" scope="row">{{++$key}}</th>
                            @endif
                            <td class="darkblue-color text-center text-nowrap align-middle"><a href="{{route('mauntaineering.show',$mauntaineering->id)}}">{{$mauntaineering->licence_number}}</a></td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$mauntaineering->licence_given_date}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$mauntaineering->organization_name}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle"><a href="#">{{$mauntaineering->region_id}}</a></td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$mauntaineering->district_id}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$mauntaineering->organization_address}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$mauntaineering->type_of_activity}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <br/>
        {{--{{ $mauntaineeringes->links() }}--}}
    </div>
@endsection



@extends('layouts.mainDiyor')
@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-between align-items-center">
            <p class="title-list">Ko'prik litsenziya ro'yhati</p>
            <form action="{{route('bridge.search')}}" method="post" class="input-group  search-input col-4 mb-3">
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
                    <li class="col px-0 mx-3 table-top-panel-items {{--active--}} {{route('bridge.index') ? 'active' : ''}}">
                        <a href="{{route('bridge.index')}}" class="text-decoration-none table-top-panel-items-link">Litsenziya olganlar</a>
                    </li>
                    <li class="col px-0 mx-3 table-top-panel-items">
                        <a href="{{--{{route('licenced')}}--}}" class="text-decoration-none table-top-panel-items-link">Jarayonda</a>
                    </li>
                </ul>


                <a href="{{route('bridge.create')}}" class="btn adding-button">
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
                       {{-- <th class="darkblue-color text-center align-top">Litsenziyalashtirish yo'nalishlari
                        </th>--}}
                        <th class="darkblue-color text-center text-nowrap align-top">Status</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Qayta Litsenziyalashtirish</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bridges as $key => $bridge)
                        <tr>
                            <th class="lightblue-color w-2 align-middle" scope="row">{{++$key}}</th>
                            <td class="darkblue-color text-center text-nowrap align-middle"><a href="{{route('bridge.show',$bridge->id)}}">{{$bridge->licence_number}}</a></td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$bridge->licence_given_date}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$bridge->organization_name}}</td>
                                <td class="darkblue-color text-center text-nowrap align-middle"><a href="#">{{$bridge->region_id}}</a></td>
                                <td class="darkblue-color text-center text-nowrap align-middle">{{$bridge->district_id}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$bridge->organization_address}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$bridge->difficulty_category}}
                            </td>
                            {{--<td class="darkblue-color text-center text-nowrap align-middle"><b><a href="">{{$project->license_direction}}</a></b></td>--}}
                            <td class="darkblue-color text-center text-nowrap align-middle">{{"Berildi"}}</td>
                            <td class="darkblue-color d-flex align-items-center justify-content-end">
                                <a href="{{route('bridge.edit', $bridge->id)}}" class="btn btn-outline-primary mr-3 text-nowrap">Qayta Litsenziyalashtirish</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <script>
            $(document).ready(function(){
                $.ajax({
                    url: 'http://api.mc.uz/info-by-inn/303018069',
                    dataType: 'json',
                    data: data,
                    success: 200
                });
                console.log("sfsfd");
/*                $.getJSON('http://api.mc.uz/info-by-inn/303018069', function(data){
                    console.log(data);
                    var organization_information = '';
                    $.each(data,function(key,value){
                        organization_information +='<tr>';
                        organization_information +='<td>'+value.acron_uz+'</td>';
                        organization_information +='</tr>';
                    });
                    $('#org_table').append(organization_information);
                });*/
            });
        </script>
        <br/>
        {{--{{$projects->render()}}--}}
    </div>
@endsection



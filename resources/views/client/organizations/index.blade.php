@extends('layouts.mainDiyor')
@section('content')

    <div class="container-fluid p-5">
        <div class="d-flex justify-content-between align-items-center">
            <form action="" method="post" class="input-group  search-input col-4 mb-3">
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
                <a href="{{route('organizations.create')}}" class="btn adding-button">
                    Yangi qo'shish <i class="fa fa-plus ml-2 mt-1"></i>
                </a>
            </div>


            <div class="table-responsive">
                <table class="table table-hover" id="org_table">
                    <thead>
                    <tr>
                        <th class="lightblue-color w-2" scope="col">#</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot nomi</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Aktivligi</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot inn</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot viloyati</th>
                        <th class="darkblue-color text-center align-top">Tashkilot tumani</th>
                        <th class="darkblue-color text-center text-nowrap align-top">Tashkilot adresi</th>
                        <th class="darkblue-color text-center align-top">Faoliyat turi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orgs as $key => $org)
                        <tr>
                            <th class="lightblue-color w-2 align-middle" scope="row">{{++$key}}</th>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$org->company_name}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$org->company_status}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$org->company_tin}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle"><a href="#">{{$org->company_ns10}}</a></td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$org->company_ns11}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$org->company_adress}}</td>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$org->performed_service}}
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
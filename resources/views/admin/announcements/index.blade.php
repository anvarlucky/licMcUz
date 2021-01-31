@extends('layouts.mainDiyor')
@section('content')
    <div class="col-12 px-0 table-box">
        <div class="table-top-panel d-flex align-items-center justify-content-between px-2 py-3">
            <a href="{{route('announcements.create')}}" class="btn adding-button">
                Yangi qo'shish <i class="fa fa-plus ml-2 mt-1"></i>
            </a>
        </div>
            <div class="table-responsive">
                <table class="table table-hover" id="org_table">
                    <thead>
                    <tr>
                        <th class="lightblue-color w-2" scope="col">#</th>
                        <th class="darkblue-color text-center text-nowrap align-top">E'lon mavzusi</th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($announcements as $key => $announcement)
                        <tr>
                            <th class="lightblue-color w-2 align-middle" scope="row">{{++$key}}</th>
                            <td class="darkblue-color text-center text-nowrap align-middle">{{$announcement->title}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection



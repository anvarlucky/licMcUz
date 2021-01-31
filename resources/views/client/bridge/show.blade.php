@extends('layouts.mainDiyor')
@section('content')
    <div class="container-fluid p-5">
        <div class="col-md-12 px-0 table-box">
            <div class="table-top-panel border-bottom d-flex align-items-center justify-content-between px-5 pt-5 pb-4">
                <p class="account-title mb-2">Litsenziya haqida ma'lumot</p>
            </div>

            <div class="account-container min-vh-75 d-flex justify-content-center py-5">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="account-photo">
                                {{--<img src="/storage/validation/photo/{{$student->photo}}" class="w-100" alt="png">--}}
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="account-info">
                                <ul class="mb-5 pb-3">
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Tashkilot nomi:
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="account-info-text">
                                                {{$bridge->organization_name}}
                                            </p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Litsenziya Berilgan sana:
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="account-info-text">
                                                {{\Carbon\Carbon::parse($bridge->licence_given_date)->format('d-m-Y')}}
                                            </p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Litsenziya raqami:
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="account-info-text">
                                                {{$bridge->licence_number}}
                                            </p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Litsenziya amal qilish muddati:
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="account-info-text">
                                                {{$bridge->end_date}}
                                                {{--{{\Carbon\Carbon::parse($student->starting_date)->format('d-m-Y')}}--}}
                                            </p>
                                        </div>
                                    </li>
                                </ul>

                                <ul class="border-A5C9FF pt-4">
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Litsenziya yangi raqami:
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="account-info-text">
                                                {{$bridge->licence_number_new}}
                                            </p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Litsenziya yo'nalishi turi:
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            @foreach($bridge->types as $type)
                                                <p class="account-info-text"><b>
                                                        {{$type->title}}
                                                    </b>
                                                </p>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="col-md-6">
                                            <p class="account-info-title">
                                                Litsenziya yo'nalishlari
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="account-info-text">
                                                {{$bridge->license_direction}}
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="qr-code-box d-flex align-items-center justify-content-center">
                                <img src="{{--{{$qrCode}}--}}" alt="QR Code" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
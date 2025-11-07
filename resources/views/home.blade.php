@extends('layouts.main_layouts')
@section('content')

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            @include ('top_bar')
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <a href="{{route('home')}}" class="d-flex align-items-center text-decoration-none">
                     <img src="assets/images/logo.png" alt="Notes logo">
                    </a>
                </div>
                <div class="col text-center">
                    A simple <span class="text-warning">Laravel</span> project!
                </div>
                <div class="col">
                    <div class="d-flex justify-content-end align-items-center">
                        <span class="me-3"><i class="fa-solid fa-user-circle fa-lg text-secondary me-3"></i>[username]</span>
                        <a href="{{route('logout')}}" class="btn btn-outline-secondary px-3">
                            Logout<i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            <!-- no notes available -->
            @if(count($notes) == 0)
            <div class="row mt-5">
                <div class="col text-center">
                    <p class="display-6 mb-5 text-secondary opacity-50">You have no notes available!</p>
                    <a href="{{route('new')}}" class="btn btn-secondary btn-lg p-3 px-5">
                        <i class="fa-regular fa-pen-to-square me-3"></i>Create Your First Note
                    </a>
                </div>
            </div>

            @else

            <!-- notes are available -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('new')}}" class="btn btn-secondary px-3">
                    <i class="fa-regular fa-pen-to-square me-2"></i>New Note
                </a>
            </div>
            @foreach ( $notes as $note )


            <div class="row">
                <div class="col">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-info">{{$note['title']}}</h4>
                                <small class="text-secondary"><span class="opacity-75 me-2">Created at:</span><strong>{{date('Y-m-d H:i:s',strtotime($note['created_at']))}}</strong></small>
                            </div>

                            <div class="col text-end">
                                <a href="{{route('edit',['id'=>Crypt::encrypt($note['id'])]) }}" class="btn btn-outline-secondary btn-sm mx-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="{{route('delete',['id'=>Crypt::encrypt($note['id'])]) }}" class="btn btn-outline-danger btn-sm mx-1"><i class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>
                        <hr>
                        <p class="text-secondary">{{$note['text']}}</p>
                    </div>
                </div>
            </div>
            @endforeach

            @endif
        </div>

    </div>
    </div>


@endsection

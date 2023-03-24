@extends('layouts.auth')
@section('content')
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-5 text-center fs-1">
                <div class="text-light fw-light"><span class="fw-bold text-info">Ayo</span>Kerjo</div>
            </div>
            <div class="col-lg-4 text-light">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/register" method="post">
                    @csrf
                    <div class="mb-4 text-center">
                        <input type="text" class="form-control text-center" placeholder="Nama lengkap" name="name"
                            required autocomplete="off">
                    </div>
                    <div class="mb-4 text-center">
                        <input type="email" class="form-control text-center" placeholder="Alamat Email" name="email"
                            required autocomplete="off">
                    </div>
                    <div class="mb-4 text-center">
                        <input type="password" class="form-control text-center" placeholder="Password" name="password"
                            required autocomplete="off">
                    </div>
                    <div class="mb-4 text-center">
                        <input type="password" class="form-control text-center" placeholder="Konfirmasi password"
                            name="confPassword" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-info" style="width:100%;">Register</button>
                    </div>
                </form>
                <div class="text-center">
                    <span>Already have account. <a href="/login" class="fw-bold text-decoration-none">Login
                            now</a></span>
                </div>
            </div>
        </div>
    </div>
@endsection

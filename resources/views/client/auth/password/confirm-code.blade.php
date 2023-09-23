@extends('client.layouts.auth')
@section('content')
    <div class="login-wrapper">
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
        <div class="loginbox">
            <div class="img-logo">
                <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                <div class="back-home">
                    {{-- <a href="index.html">Back to Home</a> --}}
                </div>
            </div>
            <h1>Enter your confirm code</h1>
            <div class="reset-password">
                <p>We've sent a code to your email to confirm</p>
            </div>
            <form action="{{ route('post-sendcode') }}" method="post">
                @csrf
                <div class="form-group d-flex gap-2">
                    {{-- <label class="form-control-label">Email</label> --}}
                    {{-- <input type="text" class="form-control" maxlength="1">
                    <input type="text" class="form-control" maxlength="1">
                    <input type="text" class="form-control" maxlength="1">
                    <input type="text" class="form-control" maxlength="1">
                    <input type="text" class="form-control" maxlength="1">
                    <input type="text" class="form-control" maxlength="1"> --}}
                    <input type="number" class="form-control" name="send_code" id="send_code"
                        placeholder="Nhập mã xác nhận gồm 6 chữ số">
                </div>
                <div class="d-grid">
                    <button class="btn btn-start" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection

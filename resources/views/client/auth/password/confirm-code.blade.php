@extends('client.layouts.auth')
@section('content')
@if(Session::get('wrong_code'));
@include('client.section.message', ['message' => session('wrong_code'),'type'=>'error'])
@endif


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
            <form action="{{ route('confirm-code') }}" method="post">
                @csrf
                <div class="form-group d-flex gap-2">
                    <input type="hidden" name="token_id" value="{{ $token_id }}">
                    <input type="number" class="form-control" name="confirmCode" id="send_code"
                        placeholder="Nhập mã xác nhận gồm 6 chữ số">
                </div>
                <div class="d-grid">
                    <button class="btn btn-start" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection

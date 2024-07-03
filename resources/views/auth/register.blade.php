@extends('layout.layout')
@section('content')
<div class="login margin-t30">
    <div class="section flex j-center align-center">
        <div class="left-section width80 flex align-center j-center">
            @if(Session::has('error'))
            <p class="text-danger">{{Session::get('error')}}</p>
            @endif
            <form action="{{ route('register') }}" method="post" class="flex-col align-center width80  j-center gap10 margin-t30" id="loginform">
                @csrf
                @method('post')
                <h1>Register</h1>
                <div class="form-div">
                    <label for="">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name">
                    @if($errors->has('name'))
                    <p class="text-danger">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="form-div">
                    <label for="">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                    @if($errors->has('email'))
                    <p class="text-danger">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <div class="form-div">
                    <label for="">Password</label>
                    <input type="password" id="password" name="password" id="password" placeholder="Enter your mobile password">
                    @if($errors->has('password'))
                    <p class="text-danger">{{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="form-div">
                    <label for="">Confirm password</label>
                    <input type="password" id="password" name="password_confirmation" id="password" placeholder="Enter your mobile password">
                </div>
                <div class="form-div flex align-center j-center">
                    <button type="submit" class="secondary-button" onclick="sendCode()" id="login-btn">
                        <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="loader">
                            <div class="ldio-55p6nv4e0l2">
                                <div></div>
                            </div>
                        </div>Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
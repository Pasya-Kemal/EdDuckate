@extends('layout.app')

@section('body')
    <div class="flex flex-col md:flex-row md:mb-8 mb-0 justify-center items-center min-h-[100vh] w-full">

        <div class="w-full mr-0 md:mr-[400px] md:w-auto">
            <div class="flex flex-col items-center justify-center">
                <img src="{{ url("images/BebekPakDengklek.gif") }}" alt="anim welcome" width="300" style="margin-left: 65px;"/>
                <div class="text-bold text-2xl">Welcome to EdDuckate</div>
            </div>
        </div>
        <div class="flex justify-center items-center max-w-[350px] w-full mt-8">
            <form method="post" action="{{ url('auth/login') }}" class="w-full p-8">
                <div class="mb-4 text-4xl font-bold text-center">
                    Login
                </div>
                @if(Session::has('login_error'))
                    <div class="mb-4">
                        <div class="rounded-lg bg-red-100 text-red-800 px-4 py-3">
                            {{ Session::get('login_error') }}
                        </div>
                    </div>
                @endif
                @csrf
                <div class="mb-4">
                    <x-text-input name="username" with-error/>
                </div>
                <div class="mb-4">
                    <x-text-input name="password" with-error/>
                </div>
                <div class="mb-4">
                    <x-button type="submit" left-icon="arrow_forward">
                        Login
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection

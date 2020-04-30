@extends('layouts.app')

@section('content')
    <form
            method="POST"
            action="{{ $user->path()  }}"
            class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow text-default"
    >
        <h1 class="text-2xl font-normal mb-10 text-center">
            Update your information
        </h1>
        @method('PATCH')
        @include('users.partials._form', ['buttonText'=> 'Update'])
    </form>
@endsection

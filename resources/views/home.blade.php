@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="lg:flex flex-wrap -mx-3">
            @forelse($users as $user)
                <div class="lg:w-1/3 px-3 pb-6">
                    @include('users.partials._card')
                </div>
            @empty
                <div class="card">No Users Yet.</div>
            @endforelse

        </main>
    </div>
@endsection

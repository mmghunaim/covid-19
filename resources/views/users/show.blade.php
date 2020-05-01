@extends('layouts.app')

@section('content')

    <main>
        <img
                src="{{ auth()->check() ? gravatar_url(Auth::user()->email) : '' }}?s=60"
                alt="{{ auth()->check() ? auth()->user()->name : '' }}'s avatar"
                class="rounded-full mr-3" style="width: 20rem; display: inline-block">

        <div style="display: inline-block" class="ml-4">
            <p class="mb-2">User name: {{$user->name}}</p>
            <p>User Email: {{$user->email}}</p>
        </div>

        <div>
            <p class="mt-10 mb-4 mr-4 text-xl" style="display: inline-block">User actions to reduce their illness</p>

            @include('users.partials._action_modal')

            @if(auth()->id() == $user->id)
                <div style="display: inline-block">
                    <a href="" class="button" @click.prevent="$modal.show('create-action')">Share new action</a>
                </div>
            @endif
            @forelse($actions as $action)
                <div class="flex justify-between w-full items-end card mb-4">
                    <p>{{ $action->action }}</p>

                    @if ($action->user->id == auth()->id())
                        @can ('manage', $action)
                            <form action="/{{ $action->path() }}" method="POST" class="text-right">
                                @csrf
                                @method('DELETE')
                                <button
                                        class="text-white no-underline rounded-lg py-2 px-5 text-sm"
                                        style="box-shadow:0 2px 7px 0 red; background-color: red"
                                        type="submit"
                                >
                                    Delete
                                </button>
                            </form>
                        @endcan
                    @endif
                </div>

            @empty
                <div class="card">
                    <p>No actions yet.</p>
                </div>
            @endforelse
        </div>
    </main>


@endsection

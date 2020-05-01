<a href="{{ $user->path() }}">
    <div class="card flex flex-col" style="height: 200px">
        <h2 class="py-4 -ml-5 border-l-4 border-blue-200 pl-4 mb-3 font-normal text-xl ">
            <a href="{{ $user->path() }}" class="text-default no-underline">{{ $user->name }}</a>
        </h2>

        <div class="mb-4 flex-1">{{ Str::limit($user->email, 80) }}</div>
    </div>
</a>


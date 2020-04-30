@csrf
<div class="field mb-6">
    <label class="lable text-sm mb-2 block" for="title">Name</label>
    <div class="control">
        <input
                type="text"
                class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full bg-card "
                name="name"
                placeholder="Name"
                value="{{ $user->name }}"
                required
        >
    </div>
    @error('name')
    <div class="text-red">{{ $message }}</div>
    @enderror
</div>

<div class="field mb-6">
    <label class="lable text-sm mb-2 block" for="description">Email</label>
    <div class="control">
        <input
                type="email"
                class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full bg-card "
                name="email"
                placeholder="Email"
                value="{{ $user->email }}"
                required
        >
    </div>
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <div class="control">
        <button
                type="submit"
                class="button is-link mr-2">
            {{ $buttonText }}
        </button>
        <a href="{{ $user->path() }}" class="text-default">Cancel</a>
    </div>
</div>

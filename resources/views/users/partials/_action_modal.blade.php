<modal name="create-action" classes="p-12 bg-card rounded-lg" height="auto" class="text-default">
    <h1 class="font-normal mb-16 text-center text-2xl">Let's share an action</h1>

    <form method="POST" action="/actions">
        @csrf
        <div class="flex-1 mr-4">
            <div class="mb-4">
                <label for="name" class="text-sm block mb-2">Action</label>

                <input
                        type="text"
                        id="name"
                        name="action"
                        class="border p-2 text-xs block w-full rounded"
                        required
                >
                @error('action')
                <div class="text-xs italic text-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <input class="button" type="submit" value="Share Action">
    </form>
</modal>

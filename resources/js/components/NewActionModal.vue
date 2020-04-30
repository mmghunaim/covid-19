<template>
    <modal name="create-action" classes="p-12 bg-card rounded-lg" height="auto" class="text-default">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's share an action</h1>

        <form @submit.prevent="createAction">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Action</label>

                        <input
                                type="text"
                                id="title"
                                class="border p-2 text-xs block w-full rounded"
                                :class="form.errors.action ? 'border-error' : 'border-muted-light'"
                                v-model="form.action">

                        <span class="text-xs italic text-error" v-if="form.errors.action"
                              v-text="form.errors.action[0]"></span>
                    </div>
                </div>

                <footer class="flex justify-end">
                    <button type="button" class="button is-outlined mr-4" @click="$modal.hide('create-action')">Cancel
                    </button>
                    <button class="button">Share Action</button>
                </footer>
                </div>
        </form>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                action: '',
            };
        },
        methods: {
            createAction() {
                axios.post('/actions', this.action)
                    .then(response => {
                        console.log(response)
                    });
            }
        }
    }
</script>

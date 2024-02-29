<script>
import Layout from './Layout.vue'

export default {
    // Using a render function...
    // layout: (h, page) => h(Layout, [page]),

    // Using shorthand syntax...
    layout: Layout,
}
</script>


<script setup>
import {useForm} from '@inertiajs/vue3'

defineProps({
    short_url: String,
    isSafeUrl: Boolean,
    threatType: String,
})

const form = useForm({
    long_url: null,
    short_url: null,
})

function submit() {
    form.post('/')
}
</script>

<template>
    <form @submit.prevent="submit">
        <label for="long_url">Long URL: </label>
        <input id="long_url" v-model="form.long_url" size="50"/>
        &nbsp <button type="submit"> Submit</button>
        <div v-if="form.errors.long_url">{{ form.errors.long_url }}</div>
        <div v-if="short_url" style="margin-top: 5px;">
            Short URL: <a :href="short_url" target="_blank"> {{ short_url }} </a>
        </div>
        <div v-if="!isSafeUrl">Given url is unsafe per Google safe browsing API.</div>
        <div v-if="threatType">threatType: {{ threatType }}</div>
    </form>
</template>



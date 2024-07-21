<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { watch } from 'vue';
import { useToast } from 'vue-toastification';


defineProps({
    posts: {
        type: Array,
        required: true
    },
});

const page = usePage();
const toast = useToast();

watch(() => page.props.message, (message) => {
    if (message) {
        toast(message.content, { type: 'success' });
    }
});

const form = useForm({
    content: "",
});

const createPost = () => {
    form.post(route('posts.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
}

</script>

<template>

    <Head title="Comments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Comments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-3">
                <form @submit.prevent="createPost" autocomplete="off"
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <label for="body" class="sr-only">Body</label>
                    <textarea v-model="form.content" v-on:focus="form.clearErrors('content')" name="content"
                        id="content" cols="30" rows="5"
                        class="border-gray-300 focus:border-indigo-500  dark:bg-gray-900 text-white focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>

                    <p v-if="form.errors.content" class="text-red-500 text-sm">
                        {{ form.errors.content }}
                    </p>
                    <button type="submit" :disabled="form.processing"
                        class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white"
                        :class="{ 'opacity-50': form.processing }">
                        Post
                    </button>
                </form>

                <div class="py-3 flex justify-center">
                    <Link preserve-scroll :only="['posts']" :href="route('posts.index')"
                        class="text-sm text-indigo-700">
                    Refresh posts
                    </Link>
                </div>

                <div v-for="post in posts" :key="post.id">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="font-semibold">{{ post.user.name }}</div>
                            <div>{{ post.content }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<template>
    <div class="max-w-xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Оставить заявку</h1>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block mb-1">Имя</label>
                <input v-model="form.name" type="text" class="w-full border rounded p-2" required />
            </div>

            <div>
                <label class="block mb-1">Телефон</label>
                <input v-model="form.phone" type="text" class="w-full border rounded p-2" required />
            </div>

            <div>
                <label class="block mb-1">Адрес</label>
                <input v-model="form.address" type="text" class="w-full border rounded p-2" required />
            </div>

            <div>
                <label class="block mb-1">Комментарий</label>
                <textarea v-model="form.comment" class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Отправить заявку
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    phone: '',
    address: '',
    comment: '',
})

function submit() {
    form.post(route('orders.store'), {
        onSuccess: () => {
            form.reset()
            alert('Заявка успешно отправлена')
        },
    })
}
</script>

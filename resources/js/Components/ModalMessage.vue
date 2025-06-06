<!-- resources/js/Components/ModalMessage.vue -->
<template>
    <div class="modal-overlay">
        <div class="modal-content">
            <h2 :class="status === 'success' ? 'success' : 'error'">
                {{ status === 'success' ? '✅ Успех' : '❌ Ошибка' }}
            </h2>
            <p>{{ message }}</p>
            <button @click="$emit('close')">Закрыть</button>
        </div>
    </div>
</template>

<script setup>
defineProps(['status', 'message']);
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 50;
}

.modal-content {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.success {
    color: green;
}

.error {
    color: red;
}

button {
    margin-top: 1rem;
    background-color: var(--primary);
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
}
</style>

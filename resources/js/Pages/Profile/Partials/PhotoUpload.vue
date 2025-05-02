<template>
    <div class="photo-upload-container">
        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label :for="id" class="form-label">{{ label }}</label>
                <div class="file-upload-wrapper">
                    <div class="file-upload-label">
                        <input
                            type="file"
                            :id="id"
                            ref="fileInput"
                            :name="name"
                            accept="image/*"
                            class="file-input"
                            @change="handleFileChange"
                        />
                        <span v-if="!file" class="file-placeholder">
                            <svg class="upload-icon" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                            <span>{{ placeholderText }}</span>
                        </span>
                        <span v-else class="file-name">{{ file.name }}</span>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-upload" :disabled="!file || loading">
                <span v-if="loading">Загрузка...</span>
                <span v-else>{{ buttonText }}</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    id: {
        type: String,
        default: 'photo-upload'
    },
    name: {
        type: String,
        default: 'photo'
    },
    label: {
        type: String,
        default: 'ФОТО ПРОФИЛЯ'
    },
    placeholderText: {
        type: String,
        default: 'Перетащите или выберите файл'
    },
    buttonText: {
        type: String,
        default: 'ОБНОВИТЬ ФОТО'
    },
    routeName: {
        type: String,
        required: true
    }
});

const emit = defineEmits(['success', 'error']);

const fileInput = ref(null);
const loading = ref(false);
const file = ref(null);

const form = useForm({
    photo: null
});

const triggerFileInput = () => {
    fileInput.value.click();
};

const handleFileChange = (e) => {
    const selectedFile = e.target.files[0];
    if (!selectedFile) return;

    if (!selectedFile.type.match('image.*')) {
        alert('Пожалуйста, выберите изображение (JPEG, PNG, GIF)');
        return;
    }

    if (selectedFile.size > 10 * 1024 * 1024) {
        alert('Файл слишком большой. Максимальный размер 10MB');
        return;
    }

    file.value = selectedFile;
    form.photo = selectedFile;
};

const submit = () => {
    if (!file.value) return;

    loading.value = true;

    form.post(route(props.routeName), {
        preserveScroll: true,
        onSuccess: () => {
            emit('success');
            form.reset();
            file.value = null;
        },
        onError: (errors) => {
            emit('error', errors);
            console.error('Ошибка загрузки:', errors);
        },
        onFinish: () => {
            loading.value = false;
        }
    });
};
</script>

<style scoped>
.photo-upload-container {
    width: 100%;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: block;
    margin-bottom: 1rem;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--primary);
}

.file-upload-wrapper {
    position: relative;
    width: 100%;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2.5rem 1.5rem;
    border: 2px dashed var(--primary);
    border-radius: 12px;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    color: var(--primary);
    background-color: rgba(0, 123, 94, 0.05);
    cursor: pointer;
    position: relative;
    min-height: 180px;
    transition: var(--transition);
}

.file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}
.file-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.upload-icon {
    width: 48px;
    height: 48px;
    fill: var(--primary);
}

.file-name {
    font-weight: 700;
    color: var(--text-dark);
    word-break: break-all;
}

.file-input:focus + .file-upload-label,
.file-upload-label:hover {
    border-color: var(--accent);
    background-color: rgba(0, 123, 94, 0.08);
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 1.25rem 2.5rem;
    border-radius: 12px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: var(--transition);
    border: none;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: var(--primary);
    z-index: -1;
}

.btn-upload {
    color: var(--white);
    box-shadow: 0 4px 12px rgba(0, 123, 94, 0.25);
}

.btn-upload:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 123, 94, 0.35);
}

.btn-upload:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-upload::after {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
}

/* Адаптив */
@media (max-width: 768px) {
    .file-upload-label {
        padding: 2rem 1rem;
        min-height: 160px;
    }
}

@media (max-width: 576px) {
    .file-upload-label {
        min-height: 140px;
    }

    .btn {
        padding: 1rem 1.5rem;
        font-size: 1rem;
    }
}
</style>

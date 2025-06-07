<template>
  <div class="modal-overlay" @click.self="$emit('close')">
    <div class="modal-content" :class="status">
      <div class="modal-header">
        <div class="modal-icon-wrapper">
          <div class="modal-icon" :class="status">
            <svg v-if="status === 'success'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <svg v-else viewBox="0 0 24 24">
              <path d="M12 12L19 19M12 12L5 5M12 12L19 5M12 12L5 19" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
        </div>
        <h2 class="modal-title">
          {{ status === 'success' ? 'Выполнено' : 'Требуется внимание' }}
        </h2>
      </div>
      <div class="modal-body">
        <p class="modal-message">{{ message }}</p>
      </div>
      <div class="modal-footer">
        <button @click="$emit('close')" class="modal-action-button" :class="status">
          {{ status === 'success' ? 'Продолжить' : 'Ясно, исправлю' }}
        </button>
      </div>
      <div class="modal-corner" :class="status"></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  status: {
    type: String,
    validator: (value) => ['success', 'error'].includes(value),
    required: true
  },
  message: {
    type: String,
    required: true
  }
});
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 20px;
  animation: fadeIn 0.3s ease;
}

.modal-content {
  position: relative;
  background: #fff;
  border-radius: 16px;
  width: 100%;
  max-width: 420px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  overflow: hidden;
  transform: translateY(0);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.modal-content:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.modal-header {
  padding: 24px 24px 16px;
  text-align: center;
}

.modal-icon-wrapper {
  margin-bottom: 16px;
}

.modal-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 64px;
  height: 64px;
  border-radius: 50%;
}

.modal-icon svg {
  width: 32px;
  height: 32px;
}

.modal-icon.success {
  background-color: rgba(0, 123, 94, 0.1);
}

.modal-icon.success svg {
  stroke: #007b5e;
}

.modal-icon.error {
  background-color: rgba(255, 58, 48, 0.1);
}

.modal-icon.error svg {
  stroke: #FF3B30;
}

.modal-title {
  font-size: 22px;
  font-weight: 600;
  margin: 0;
  color: #222;
}

.success .modal-title {
  color: #007b5e;
}

.error .modal-title {
  color: #FF3B30;
}

.modal-body {
  padding: 0 24px;
}

.modal-message {
  font-size: 16px;
  line-height: 1.5;
  color: #555;
  margin: 0 0 24px;
  text-align: center;
}

.modal-footer {
  padding: 0 24px 24px;
  text-align: center;
}

.modal-action-button {
  display: inline-block;
  padding: 12px 32px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  border: none;
  transition: all 0.3s ease;
  width: 100%;
  max-width: 240px;
}

.success .modal-action-button {
  background: linear-gradient(135deg, #007b5e, #00997a);
  color: white;
}

.error .modal-action-button {
  background: linear-gradient(135deg, #FF3B30, #FF6B60);
  color: white;
}

.modal-action-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.modal-corner {
  position: absolute;
  top: 0;
  right: 0;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 0 60px 60px 0;
  border-color: transparent rgba(0, 123, 94, 0.1) transparent transparent;
}

.error .modal-corner {
  border-color: transparent rgba(255, 58, 48, 0.1) transparent transparent;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Адаптивные стили */
@media (max-width: 768px) {
  .modal-header {
    padding: 20px 20px 12px;
  }

  .modal-icon {
    width: 56px;
    height: 56px;
  }

  .modal-icon svg {
    width: 28px;
    height: 28px;
  }

  .modal-title {
    font-size: 20px;
  }

  .modal-body {
    padding: 0 20px;
  }

  .modal-message {
    font-size: 15px;
    margin-bottom: 20px;
  }

  .modal-footer {
    padding: 0 20px 20px;
  }

  .modal-action-button {
    padding: 10px 24px;
    font-size: 15px;
  }

  .modal-corner {
    border-width: 0 50px 50px 0;
  }
}

@media (max-width: 480px) {
  .modal-overlay {
    padding: 10px;
  }

  .modal-header {
    padding: 16px 16px 8px;
  }

  .modal-icon {
    width: 48px;
    height: 48px;
  }

  .modal-icon svg {
    width: 24px;
    height: 24px;
  }

  .modal-title {
    font-size: 18px;
  }

  .modal-body {
    padding: 0 16px;
  }

  .modal-message {
    font-size: 14px;
    margin-bottom: 16px;
  }

  .modal-footer {
    padding: 0 16px 16px;
  }

  .modal-action-button {
    padding: 10px 16px;
    font-size: 14px;
    max-width: 100%;
  }

  .modal-corner {
    border-width: 0 40px 40px 0;
  }
}
</style>

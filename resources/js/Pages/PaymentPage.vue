<template>
    <div>
        <h1>Подтверждение оплаты</h1>
        <form @submit.prevent="submitPayment">
            <div>
                <label for="number">Номер карты:</label>
                <input type="text" id="number" v-model="payment.number" required />
            </div>
            <div>
                <label for="expiry">Срок действия:</label>
                <input type="text" id="expiry" v-model="payment.expiry" required />
            </div>
            <div>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" v-model="payment.cvv" required />
            </div>
            <button type="submit">Оплатить</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            payment: {
                number: '',
                expiry: '',
                cvv: ''
            }
        };
    },
    methods: {
        submitPayment() {
            this.$inertia.post(route('payment.confirm'), this.payment);
        }
    }
};
</script>

<template>
    <div class="columns is-vcentered">
        <div class="column is-6 is-offset-3">
            <form @submit="createTransaction">
                <div class="title">Enter Transaction</div>
                <div class="field">
                    <label class="label">Amount Due ($USD)</label>
                    <div class="control has-icons-left has-icons-right">
                        <currency-input v-model="due" class="currency" />
                    </div>
                </div>

                <div class="field">
                    <label class="label">Amount Provided ($USD)</label>
                    <div class="control has-icons-left has-icons-right">
                        <currency-input v-model="provided" class="currency" />
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Enter Sale</button>
                    </div>
                    <div class="control">
                        <button @click="clearFields" class="button is-link is-light">Clear</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="column">
            <p
                class="change"
                v-for="(item, index) in change"
                v-bind:key="index"
            >{{ index }}: {{ item }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Register',
    data() {
        return {
            msg: 'hello',
            due: 100.0,
            provided: 200.0,
            change: {},
        };
    },
    methods: {
        async createTransaction(e) {
            e.preventDefault();
            try {
                const res = await axios.post('/transaction', {
                    due: this.due,
                    provided: this.provided,
                });

                if (!res) throw new Error('transaction failed');
                this.change = res.data;
            } catch (error) {
                throw new Error(`transaction failed: ${error}`);
            }
        },
        clearFields() {
            this.due = 0.0;
            this.provided = 0.0;
            change = {};
        },
    },
};
</script>

<style scoped lang="scss">
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 1.5rem;
    .currency,
    .change {
        font-size: 1rem;
        padding: 0.5rem;
        outline: none;
    }
    .field.is-grouped {
        margin-top: 1rem;
    }
}
</style>

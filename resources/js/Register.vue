<template>
    <div class="columns">
        <div class="column is-6 is-offset-3">
            <form class="card" @submit="createTransaction">
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
                    <!-- <div class="control">
                        <button class="button is-link is-light">Clear</button>
                    </div> -->
                </div>
            </form>
            <div class="columns">
                <div class="column">
                    <h4>${{ change }}</h4>
                </div>
            </div>
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
            change: 0.0,
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
                if (!res) {
                    throw new Error('transaction failed');
                }
                // this.change = res.data;
                console.log(res.data);
            } catch (error) {
                throw new Error(`transaction failed: ${error}`);
            }
        },
    },
};
</script>

<style scoped lang="scss">
form.card {
    padding: 1.5rem;
    .currency {
        font-size: 1rem;
        padding: 0.5rem;
    }
}
</style>

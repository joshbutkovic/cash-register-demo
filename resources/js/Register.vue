<template>
    <div class="columns is-vcentered has-text-centered" @keyup.enter="createTransaction">
        <transition name="fade" mode="out-in">
            <div v-if="status === 'start'" class="column is-6 is-offset-3" key="1">
                <form @submit="createTransaction">
                    <div class="title">Start Sale</div>
                    <div class="field">
                        <label class="label">Amount Due ($USD)</label>
                        <div class="control has-icons-left has-icons-right">
                            <currency-input v-model="due" class="currency" />
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Amount Provided ($USD)</label>
                        <div class="control has-icons-left has-icons-right">
                            <currency-input
                                v-model="provided"
                                class="currency"
                                v-bind:class="{ 'is-danger': isProvidedError }"
                            />
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
            <div v-else class="column is-6 is-offset-3 has-text-centered" key="2">
                <div class="title">Return Change</div>
                <p
                    style="font-size: 2rem;"
                    v-for="(item, index) in change"
                    v-bind:key="index"
                >{{ index }}: {{ item }}</p>
                <div class="field another-sale">
                    <div class="control">
                        <button class="button is-link" @click="clearFields">Another Sale</button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import Confirmation from './Confirmation';
export default {
    name: 'Register',
    components: { Confirmation },
    data() {
        return {
            msg: 'hello',
            due: null,
            provided: null,
            change: {},
            status: 'start',
            isProvidedError: false,
        };
    },
    methods: {
        async createTransaction(e) {
            e.preventDefault();

            if (!this.provided || !this.due) {
                alert('Provider and Due fields are required.');
                return;
            }

            if (this.provided < this.due) {
                this.isProvidedError = true;
                return;
            }

            try {
                const res = await axios.post('/transaction', {
                    due: this.due,
                    provided: this.provided,
                });

                if (!res) throw new Error('transaction failed');
                this.change = res.data;
                this.status = 'confirm';
                this.isProvidedError = false;
            } catch (error) {
                console.log('error');
                throw new Error(`transaction failed: ${error}`);
            }
        },
        clearFields(e) {
            e.preventDefault();
            this.due = 0.0;
            this.provided = 0.0;
            this.status = 'start';
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
    p.change.results {
        font-size: 1.25rem !important;
        font-weight: 200;
        padding: 0.5rem;
        outline: none;
    }
    .field.is-grouped {
        margin-top: 1rem;
    }
    .currency.is-danger {
        border: 1px solid red;
    }
}
div.field.another-sale {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
}
</style>

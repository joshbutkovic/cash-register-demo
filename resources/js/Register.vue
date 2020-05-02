<template>
    <div class="columns">
        <div class="column is-6 is-offset-3">
            <form class="card">
                <div class="title">Enter Transaction</div>
                <div class="field">
                    <label class="label">Total Cost</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Text input" />
                    </div>
                </div>

                <div class="field">
                    <label class="label">Amount Provided</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-success" type="text" placeholder="Text input" value="bulma" />
                        <currency-input v-model="amount" />
                        <!-- <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>-->
                    </div>
                    <p class="help is-success">This username is available</p>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Submit</button>
                    </div>
                    <div class="control">
                        <button class="button is-link is-light">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Register',
    data() {
        return {
            msg: 'hello',
            amount: '',
        };
    },
};
</script>

<style scoped style="scss">
form.card {
    padding: 1rem;
}
</style>

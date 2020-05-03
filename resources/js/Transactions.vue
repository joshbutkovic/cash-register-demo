<template>
    <div>
        <h1 class="is-size-3 title">Transactions</h1>
        <div class="table-container">
            <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Due</td>
                        <td>Provided</td>
                        <td>$100</td>
                        <td>$50</td>
                        <td>$20</td>
                        <td>$10</td>
                        <td>$5</td>
                        <td>$1</td>
                        <td>$Q</td>
                        <td>$D</td>
                        <td>$N</td>
                        <td>$P</td>
                        <td style="min-width: 100px;">Sold At</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in transactions.slice().reverse()" v-bind:key="index">
                        <td>{{ item.id }}</td>
                        <td>${{ Number(item.due).toLocaleString() }}</td>
                        <td>${{ Number(item.provided).toLocaleString() }}</td>
                        <td>{{ item.hundreds ? Number(item.hundreds).toLocaleString() : 0 }}</td>
                        <td>{{ item.fifties ? item.fifties : 0 }}</td>
                        <td>{{ item.twenties ? item.twenties : 0 }}</td>
                        <td>{{ item.tens ? item.tens : 0 }}</td>
                        <td>{{ item.fives ? item.fives : 0 }}</td>
                        <td>{{ item.ones ? item.ones : 0 }}</td>
                        <td>{{ item.quarters ? item.quarters : 0 }}</td>
                        <td>{{ item.dimes ? item.dimes : 0 }}</td>
                        <td>{{ item.nickles ? item.nickles : 0 }}</td>
                        <td>{{ item.pennies ? item.pennies : 0 }}</td>
                        <td>{{ filterDate(item.created_at) }}</td>
                        <td><a class="is-link is-small" @click="deleteTransaction(item.id)">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Transactions',
    data() {
        return {
            transactions: [],
        };
    },
    created() {
        this.getTransactions();
    },
    methods: {
        async getTransactions() {
            try {
                const res = await axios.get('/transaction/all');

                if (!res) throw new Error('no transaction data');
                this.transactions = res.data;
            } catch (error) {
                console.log('error');
                throw new Error(`transaction data retrieval failed: ${error}`);
            }
        },
        filterDate(date) {
            let inDate = new Date(date);
            return inDate.toLocaleTimeString('en-US');
        },
        async deleteTransaction(id) {
            if (confirm(`Permanently Delete Transaction ${id} ?`)) {
                try {
                    const res = await axios.delete(`/transaction/delete/${id}`);

                    if (!res) throw new Error('no transaction data');
                    this.getTransactions();
                } catch (error) {
                    console.log('error');
                    throw new Error(`transaction data retrieval failed: ${error}`);
                }
            }
        },
    },
};
</script>

<style lang="scss" scoped>
h1.is-size-3 {
    margin-bottom: 1rem;
}
table {
    thead tr td {
        font-weight: 700;
    }
}
</style>

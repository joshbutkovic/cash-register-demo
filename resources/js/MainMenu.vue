<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link class="navbar-item navbar-logo" to="/">Point of Sale</router-link>
            <router-link class="navbar-item is-hoverable" to="/transactions">Transactions</router-link>
        </div>
    </nav>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
export default {
    name: 'MainMenu',
    components: { FontAwesomeIcon },
};
</script>

<style scoped lang="scss">
$white: #fff;
$black: #000;
$menu-bg: #3273dc;

.navbar {
    background-color: $menu-bg;
    min-height: 3.4rem;
    box-shadow: 0 3px 7px rgba(0, 0, 0, 0.25), 0 3px 3px rgba(0, 0, 0, 0.22);
    .navbar-brand a.navbar-item.navbar-logo {
        font-size: 1.4rem;
        background: $menu-bg;
        &:hover {
            transition: none;
        }
    }
    .navbar-menu {
        display: block !important;
        flex-grow: 1 !important;
        flex-shrink: 0 !important;
        align-items: stretch !important;
    }
    a.navbar-item {
        color: #ededed;
        -webkit-transition: all 5ms ease-in-out;
        transition: all 250ms ease-in-out;
        font-size: 14px;
        font-weight: bold;
        padding: 0 18px;
        margin: 0 4px;
        align-items: center;
        &:hover:not(.navbar-logo),
        &:hover:not(.navbar-logo),
        &:active:not(.navbar-logo),
        &.is-active:not(.navbar-logo) {
            background-color: $menu-bg;
            color: $white;
        }
        &:focus,
        &:focus-within {
            background-color: $menu-bg;
            transition: none;
        }
    }
    a.navbar-item.is-hoverable {
        text-transform: uppercase;
    }
    .navbar-end {
        align-items: center;
    }
    .svg-inline--fa.fa-w-16 {
        font-size: 1.125rem;
    }
}
</style>

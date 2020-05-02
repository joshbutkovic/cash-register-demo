<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link class="navbar-item navbar-logo" to="/">I-View Now Cash Register</router-link>
        </div>
        <div id="main-menu" class="navbar-menu">
            <div class="navbar-end ivcr-links">
                <router-link
                    v-for="item of navItems"
                    v-bind:key="item.index"
                    :class="'navbar-item is-hoverable ' + item.toLowerCase()"
                    :to="'/' + item.toLowerCase()"
                    >{{ item }}</router-link
                >
            </div>
        </div>
    </nav>
</template>

<script>
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
export default {
    name: 'MainMenu',
    // components: { FontAwesomeIcon },
    data() {
        return {
            navItems: ['Register', 'Reports'],
        };
    },
};
</script>

<style scoped lang="scss">
$menu-bg: #141414;
$primary: green;
$white: #fff;
$black: #000;

.navbar {
    background-color: $menu-bg;
    min-height: 3.4rem;
    .navbar-brand a.navbar-item.navbar-logo {
        font-size: 1.4rem;
        background: #141414;
        &:hover {
            transition: none;
        }
    }
    a.navbar-item {
        color: #ededed;
        -webkit-transition: all 5ms ease-in-out;
        transition: all 250ms ease-in-out;
        font-size: 15px;
        padding: 0 18px;
        margin: 0 4px;
        align-items: center;
        &:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 4px;
            transform: scaleX(0);
            background-color: $primary;
            transition: transform 200ms;
            top: 34px;
        }
        &:hover:not(.navbar-logo),
        &:hover:not(.navbar-logo),
        &:active:not(.navbar-logo),
        &.is-active:not(.navbar-logo) {
            background-color: $menu-bg;
            color: $white;
            &:after {
                transform: scaleX(1);
            }
        }
        &:focus,
        &:focus-within {
            background-color: $menu-bg;
            transition: none;
        }
    }
    .navbar-end {
        align-items: center;
    }
    .svg-inline--fa.fa-w-16 {
        font-size: 1.125rem;
    }
}
</style>

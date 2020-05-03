<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Point of Sale</title>
        <link href="/css/app.css" rel="stylesheet" />
    </head>
    <body>
       <div id="app">
            <main-menu></main-menu>
            <section class="section">
                <div class="container">
                    <transition name="fade" mode="out-in">
                        <router-view></router-view>
                    </transition>
                </div>
            </section>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>

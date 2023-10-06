<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        :root {
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            :root {
                font-family: 'Inter var', sans-serif;
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

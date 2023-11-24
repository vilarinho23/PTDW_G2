<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @yield("head")
</head>
<body>
    @yield("header")
    @yield("content")
</body>

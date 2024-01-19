<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @yield("head")
    @yield("head_plus")
</head>
<body>
    @yield("header")
    @yield("content")
</body>

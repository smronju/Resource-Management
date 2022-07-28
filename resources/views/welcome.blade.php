<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Resource Management') }}</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="root" class="d-flex flex-column h-100"></div>

        @vite('resources/js/app.js')
    </body>
</html> -->



<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Resource Management System">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>{{ config('app.name', 'Resource Management') }}</title>
    
    @vite('resources/css/app.css')
  </head>
  <body class="d-flex flex-column h-100">
    <div id="root" class="d-flex flex-column h-100"></div>
    
    @vite('resources/js/app.js')      
  </body>
</html>

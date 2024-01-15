<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMTS - @yield('title')</title>
    @yield('csrf')
    <meta name="description" content="A modern CRM Dashboard Template with reusable and flexible components for your SaaS web applications by hencework. Based on Bootstrap."/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Data Table CSS -->
    <link href="{{ asset('/') }}assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
{{--<link href="assets/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />--}}

    <!-- CSS -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/') }}assets/css/toastr.min.css" rel="stylesheet" type="text/css">
    @yield('style')
</head>
<body>
<!-- Wrapper -->
<div class="hk-wrapper" data-layout="vertical" data-layout-style="default" data-menu="light" data-footer="simple">

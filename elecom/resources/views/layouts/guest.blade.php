<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <title>Đăng nhập</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('admin_asset/img/photos/blocks.png') }}" type="image/png">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen bg-cover bg-center relative" style="background-image: url('{{ asset('admin_asset/img/photos/transformers-one-2024.jpg') }}');">
        <div class="absolute inset-0 bg-blue-200 bg-opacity-40"></div>

        <div class="relative min-h-screen flex items-center justify-center">
            <div class=" shadow-lg rounded-lg max-w-4xl w-full grid grid-cols-1 sm:grid-cols-2" style="background-color: rgba(255, 255, 255, 0.726);">
                <!-- Phần hình ảnh -->
                <div class="flex items-center justify-center p-6">
                    <img src="{{ asset('admin_asset/img/photos/Ecommerce.png') }}" alt="Ecommerce Logo" class="max-w-full h-auto object-cover">
                </div>

                <!-- Phần nội dung -->
                <div class="p-6 flex flex-col items-center justify-center">
                    <a href="/" class="mb-4">
                        <x-application-logo class="w-20 h-20 text-gray-500" />
                    </a>
                    <h1 class="text-xl font-bold text-gray-700 mb-4">MyKingToys</h1>
                    <div class="w-full">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng nhập</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('admin_asset/img/photos/blocks.png') }}" type="image/png">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
        <style>
            .img_bg{
                background: url("{{asset('admin_asset/img/photos/transformers-one-2024.jpg')}}") rgba(135, 207, 235, 0.511) no-repeat cover cover/center;
                width: 100%;
                height: auto;
            }
        </style>
        <div class="img_bg">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div class="bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <div class="row">
                        <div class="col-6">
                            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-transparent overflow-hidden sm:rounded-lg">
                                <center>
                                    <img src="{{asset('admin_asset/img/photos/Ecommerce.png')}}" alt="" style="width: auto;height: auto;object-fit: cover">
                                </center>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-transparent overflow-hidden sm:rounded-lg">
                                <div>
                                    <center>
                                        <a href="/">
                                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                                        </a>
                                        MyKingToys
                                    </center>
                                </div>

                                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-transparent overflow-hidden sm:rounded-lg">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html> --}}

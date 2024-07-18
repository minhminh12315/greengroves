<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css">
    <!-- Swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('asset/index.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    @livewireStyles
</head>

<body>
    @include('sweetalert::alert')
    {{ $slot }}

    <div class="backdrops"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('asset/app.js') }}"></script>
    <script type="importmap">
        {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
                }
            }
        </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Paragraph, Bold, Italic, Font],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                window.editor = editor;
                const livewireComponent = Livewire.find(
                    document.querySelector('#editor').closest('[wire\\:id]').getAttribute('wire:id')
                );
                editor.model.document.on('change:data', () => {
                    let desc = $('#editor').data('desc');
                    eval(desc).set('description', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        window.onload = function() {
            if (window.location.protocol === "file:") {
                alert("This sample requires an HTTP server. Please serve this file with a web server.");
            }
        };
        document.addEventListener('closeModal', () => {
            $('.modal').modal("hide")
        });
        $(document).ready(function() {
            let swiperCards = new Swiper(".card-swiper-content", {
                loop: true,
                spaceBetween: 10,
                grabCursor: true,

                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },

                breakpoints: {
                    0: {
                        slidesPerView: 2,
                    },
                    400: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    1400: {
                        slidesPerView: 4,
                    },
                },
            });
            $(document).on('livewire:init', function() {
                Livewire.on('swalsuccess', (e) => {
                    const data = e;
                    Swal.fire({
                        icon: data[0].icon,
                        title: data[0].title,
                        text: data[0].text,
                        showConfirmButton: true
                    });
                });
            });
            $(document).on('livewire:init', function() {
                Livewire.on('checkoutsuccess', (e) => {
                    const data = e;
                    Swal.fire({
                        icon: data[0].icon,
                        title: data[0].title,
                        text: data[0].text,
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/'; // Chuyển hướng về route users.home
                        }
                    });
                });
            });
            $('.btn-showAsideSetting').click(() => {
                $('#aside_setting_container').toggleClass('show');
                $('.backdrops').toggleClass('active');
            })
            $('.btn-close-asideSetting').click(() => {
                $('#aside_setting_container').toggleClass('show');
                $('.backdrops').toggleClass('active');
            })
            $('.backdrops').click(() => {
                $('#aside_setting_container').removeClass('show');
                $('.backdrops').removeClass('active');
            });
            $(document).on('livewire:init', function() {
                Livewire.on('swalsuccess', (e) => {
                    const data = e;
                    Swal.fire({
                        icon: data[0].icon,
                        title: data[0].title,
                        text: data[0].text,
                        showConfirmButton: true
                    });
                });
            });
        });
    </script>
    
    @livewireScripts
</body>

</html>
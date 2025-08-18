<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="robots" content="noindex">
    <link href="{{ asset('/css/aibotdesign.css') }}" rel="stylesheet" />
    {{-- <link href="~/css/site.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <x-app-layout>
        <div class="wrapper">
            <div class="main">
                <div class="container" style="width:100%;height:88%; margin-top: 20px">
                    <article role="log" aria-live="polite" aria-atomic="false">
                        <ul class="chat"></ul>
                        <noscript>
                            <ul class="chat">
                                <li class="message bot show">
                                    <p>I'm sorry, but you need JavaScript turned on for this website to function.</p>
                                </li>
                            </ul>
                        </noscript>
                    </article>
                    <div class="content" role="document" aria-hidden="true" aria-label="Information">
                        <button class="close" aria-label="Close">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="{{ asset('/js/aibotdesign.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('headerImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('headerImagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
</body>

</html>

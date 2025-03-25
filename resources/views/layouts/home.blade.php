<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Berita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/navbar.css', 'resources/js/navbar.js']) {{-- Memanggil file css dan js yang telah di compile oleh vite --}}
</head>
<body>
   @include('partials.navbar')
     <!-- Breaking News -->
     <div class="breaking-news">
        <div class="breaking-container">
            <div class="breaking-title">BERITA TERKINI:</div>
            <div class="breaking-news-ticker">
                <div class="breaking-news-items">
                    @if(isset($beritas) && count($beritas) > 0)
                    @foreach ($beritas as $berita)
                        <div class="breaking-news-item">{{ $berita->judul }}</div>
                    @endforeach
                    @else
                    <div class="breaking-news-item"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

        <!-- Content placeholder -->
            @yield('content')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    .sign-in-btn {
    background-color: #e74c3c;
    color: white;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: none;
}

.sign-in-btn:hover {
    background-color: #2c3e50;
    color: #e74c3c;
}
@media screen and (max-width: 768px) {
    .sign-in-btn {
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
    }
}
</style>
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" opacity="0.25"/>
                <path d="M12,7v5l3,3"/>
            </svg>
            <div class="logo-text"><a href="{{route('berita.index')}}" style="text-decoration: none; color:white;">BeritaKini</a></div>
        </div>

        <ul class="menu">
            <li class="active"><a href="{{route('berita.index')}}">Beranda</a></li>
            <li><a href="{{route('berita.category', 'Nasional')}}">Nasional</a></li>
            <li><a href="{{route('berita.category', 'Internasional')}}">Internasional</a></li>
            <li><a href="{{route('berita.category', 'Ekonomi')}}">Ekonomi</a></li>
            <li><a href="{{route('berita.category', 'Olahraga')}}">Olahraga</a></li>
            <li><a href="{{route('berita.category', 'Teknologi')}}">Teknologi</a></li>
            <li><a href="{{route('berita.category', 'Hiburan')}}">Hiburan</a></li>
            <li><a href="{{route('berita.category', 'Gaya Hidup')}}">Gaya Hidup</a></li>
        </ul>
        {{-- @if(!Auth::guard('admin')->check()) --}}
        <button class="sign-in-btn" id="search-toggle" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
        {{-- else --}}
        {{-- <form method="POST" action="#">
            @csrf
            <button class="sign-in-btn" type="submit">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </button>
        </form> --}}
        @endif
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    @stack('modals')
</nav>

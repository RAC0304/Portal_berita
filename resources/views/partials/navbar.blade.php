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
            <li class="active"><a href="#">Beranda</a></li>
            <li><a href="#">Nasional</a></li>
            <li><a href="#">Internasional</a></li>
            <li><a href="#">Ekonomi</a></li>
            <li><a href="#">Olahraga</a></li>
            <li><a href="#">Teknologi</a></li>
            <li><a href="#">Hiburan</a></li>
            <li><a href="#">Gaya Hidup</a></li>
        </ul>

        <button class="sign-in-btn" id="search-toggle">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

// File: public/js/berita-admin.js

document.addEventListener("DOMContentLoaded", function () {
    // Tambahkan atribut data-label untuk tampilan mobile
    setupResponsiveTable();

    // Konfirmasi sebelum menghapus
    setupDeleteConfirmation();

    // Animasi pada tabel
    setupTableAnimations();

    // Preview gambar saat hover
    setupImagePreviews();
});

/**
 * Menambahkan atribut data-label pada sel tabel untuk tampilan responsif
 */
function setupResponsiveTable() {
    const table = document.querySelector(".table");
    if (!table) return;

    const headers = Array.from(table.querySelectorAll("thead th"));
    const headerTexts = headers.map((header) => header.textContent.trim());

    // Abaikan kolom terakhir (Aksi)
    headerTexts.pop();

    const rows = table.querySelectorAll("tbody tr");
    rows.forEach((row) => {
        const cells = Array.from(row.querySelectorAll("td"));
        // Abaikan sel terakhir (Aksi)
        for (let i = 0; i < cells.length - 1; i++) {
            if (i < headerTexts.length) {
                cells[i].setAttribute("data-label", headerTexts[i]);
            }
        }
    });
}

/**
 * Menambahkan konfirmasi sebelum menghapus berita
 */
function setupDeleteConfirmation() {
    const deleteForms = document.querySelectorAll('form[action*="berita/"]');
    deleteForms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            if (!confirm("Apakah Anda yakin ingin menghapus berita ini?")) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Menambahkan animasi pada tabel
 */
function setupTableAnimations() {
    const rows = document.querySelectorAll(".table tbody tr");

    // Animation on page load
    rows.forEach((row, index) => {
        row.style.opacity = "0";
        row.style.transform = "translateY(20px)";
        row.style.transition = "opacity 0.3s ease, transform 0.3s ease";

        setTimeout(() => {
            row.style.opacity = "1";
            row.style.transform = "translateY(0)";
        }, 100 + index * 50);
    });

    // Highlight row on click
    rows.forEach((row) => {
        row.addEventListener("click", function (e) {
            // Jangan lakukan highlight jika yang diklik adalah tombol atau link
            if (
                e.target.tagName.toLowerCase() === "button" ||
                e.target.tagName.toLowerCase() === "a"
            ) {
                return;
            }

            rows.forEach((r) => r.classList.remove("table-active"));
            this.classList.add("table-active");
        });
    });
}

/**
 * Menambahkan preview gambar saat hover
 */
function setupImagePreviews() {
    const images = document.querySelectorAll(".table img");

    images.forEach((img) => {
        const originalSrc = img.getAttribute("src");
        const originalWidth = img.width;
        const originalHeight = img.height;

        img.addEventListener("mouseenter", function () {
            this.style.transition = "all 0.3s ease";
            this.style.transform = "scale(3)";
            this.style.zIndex = "100";
            this.style.boxShadow = "0 5px 15px rgba(0,0,0,0.3)";
        });

        img.addEventListener("mouseleave", function () {
            this.style.transform = "scale(1)";
            this.style.zIndex = "1";
            this.style.boxShadow = "0 2px 5px rgba(0,0,0,0.1)";
        });
    });
}

/**
 * Menangani fitur pencarian cepat di tabel
 * (Jika ingin menambahkan fitur ini di masa depan)
 */
function setupQuickSearch() {
    // Tambahkan elemen input pencarian
    const container = document.querySelector(".container");
    const table = document.querySelector(".table");

    if (!container || !table) return;

    const searchDiv = document.createElement("div");
    searchDiv.className = "mb-3";
    searchDiv.innerHTML = `
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input type="text" class="form-control" id="quickSearch" placeholder="Cari berita...">
        </div>
    `;

    // Sisipkan setelah tombol Tambah Berita
    const addButton = container.querySelector(".btn-primary");
    if (addButton) {
        addButton.parentNode.insertBefore(searchDiv, addButton.nextSibling);
    } else {
        container.insertBefore(searchDiv, table);
    }

    // Implementasi fitur pencarian
    const searchInput = document.getElementById("quickSearch");
    searchInput.addEventListener("keyup", function () {
        const searchTerm = this.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach((row) => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
}

/**
 * Tambahkan kelas warna berdasarkan status
 * (Untuk pengembangan di masa depan jika ada kolom status)
 */
function setupStatusColors() {
    // Contoh: jika ada kolom status
    const statusCells = document.querySelectorAll(".table td.status");
    statusCells.forEach((cell) => {
        const status = cell.textContent.trim().toLowerCase();
        if (status === "published") {
            cell.classList.add("text-success");
        } else if (status === "draft") {
            cell.classList.add("text-warning");
        } else if (status === "archived") {
            cell.classList.add("text-secondary");
        }
    });
}

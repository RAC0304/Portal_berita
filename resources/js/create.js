document.addEventListener("DOMContentLoaded", function () {
    // Animation delays for form elements
    const formGroups = document.querySelectorAll(".form-group");
    formGroups.forEach((group, index) => {
        const label = group.querySelector("label");
        if (label) {
            label.style.animationDelay = `${0.2 + index * 0.1}s`;
        }
    });

    // File upload preview
    const fileInput = document.querySelector('input[name="gambar"]');
    if (fileInput) {
        const fileUploadContainer = document.createElement("div");
        fileUploadContainer.className = "file-upload";

        const fileLabel = document.createElement("label");
        fileLabel.className = "file-upload-label";
        fileLabel.innerHTML =
            '<i class="fas fa-cloud-upload-alt"></i> Pilih Gambar';
        fileLabel.setAttribute("for", "file-upload-input");

        const fileName = document.createElement("div");
        fileName.className = "file-name";
        fileName.textContent = "Tidak ada file yang dipilih";

        const previewContainer = document.createElement("div");
        previewContainer.className = "preview-container";

        const imagePreview = document.createElement("img");
        imagePreview.className = "image-preview";

        previewContainer.appendChild(imagePreview);

        // Replace the original file input
        const originalParent = fileInput.parentNode;
        fileInput.id = "file-upload-input";
        fileInput.style.position = "absolute";
        fileInput.style.left = "-9999px";

        fileUploadContainer.appendChild(fileInput.cloneNode(true));
        fileUploadContainer.appendChild(fileLabel);
        originalParent.appendChild(fileUploadContainer);
        originalParent.appendChild(fileName);
        originalParent.appendChild(previewContainer);
        originalParent.removeChild(fileInput);

        // Add event listener to the new file input
        originalParent
            .querySelector('input[type="file"]')
            .addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    fileName.textContent = file.name;

                    // Show image preview if it's an image
                    if (file.type.match("image.*")) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            imagePreview.src = e.target.result;
                            previewContainer.style.display = "block";

                            // Add animation to the preview image
                            imagePreview.style.opacity = "0";
                            imagePreview.style.transform = "scale(0.8)";
                            imagePreview.style.transition = "all 0.3s ease";

                            setTimeout(() => {
                                imagePreview.style.opacity = "1";
                                imagePreview.style.transform = "scale(1)";
                            }, 50);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.style.display = "none";
                    }
                } else {
                    fileName.textContent = "Tidak ada file yang dipilih";
                    previewContainer.style.display = "none";
                }
            });
    }

    // Form validation and submission animations
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (e) {
            let isValid = true;
            const inputs = form.querySelectorAll(
                "input[required], textarea[required]"
            );

            inputs.forEach((input) => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = "#e74c3c";

                    // Find or create feedback message
                    let feedback = input.nextElementSibling;
                    if (
                        !feedback ||
                        !feedback.classList.contains("input-feedback")
                    ) {
                        feedback = document.createElement("div");
                        feedback.className = "input-feedback";
                        input.parentNode.insertBefore(
                            feedback,
                            input.nextElementSibling
                        );
                    }

                    feedback.textContent = "Field ini harus diisi";
                    feedback.style.display = "block";

                    // Add shake animation
                    input.classList.add("shake-input");
                    setTimeout(() => {
                        input.classList.remove("shake-input");
                    }, 500);
                } else {
                    input.style.borderColor = "#e0e0e0";
                    const feedback = input.nextElementSibling;
                    if (
                        feedback &&
                        feedback.classList.contains("input-feedback")
                    ) {
                        feedback.style.display = "none";
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
            } else {
                // Add successful submit animation
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML =
                    '<span class="spinner"></span> Menyimpan...';
                submitBtn.disabled = true;

                // For demo purposes, we'll add the animation here
                // In a real app, this would be handled by the server response
                if (window.location.href.includes("demo")) {
                    e.preventDefault();
                    setTimeout(() => {
                        submitBtn.innerHTML =
                            '<i class="fas fa-check"></i> Berhasil Disimpan!';
                        submitBtn.style.backgroundColor = "#2ecc71";

                        setTimeout(() => {
                            form.reset();
                            submitBtn.innerHTML = "Simpan";
                            submitBtn.disabled = false;
                            submitBtn.style.backgroundColor = "#3498db";

                            // Reset file input display
                            const fileName =
                                document.querySelector(".file-name");
                            if (fileName) {
                                fileName.textContent =
                                    "Tidak ada file yang dipilih";
                            }

                            const previewContainer =
                                document.querySelector(".preview-container");
                            if (previewContainer) {
                                previewContainer.style.display = "none";
                            }
                        }, 2000);
                    }, 1500);
                }
            }
        });

        // Real-time validation
        const inputs = form.querySelectorAll("input, textarea");
        inputs.forEach((input) => {
            input.addEventListener("input", function () {
                if (input.hasAttribute("required") && !input.value.trim()) {
                    input.style.borderColor = "#e74c3c";
                } else {
                    input.style.borderColor = "#e0e0e0";
                    const feedback = input.nextElementSibling;
                    if (
                        feedback &&
                        feedback.classList.contains("input-feedback")
                    ) {
                        feedback.style.display = "none";
                    }
                }
            });

            // Focus and blur effects
            input.addEventListener("focus", function () {
                this.parentNode.classList.add("input-focus");
            });

            input.addEventListener("blur", function () {
                this.parentNode.classList.remove("input-focus");
            });
        });
    }

    // Add custom styles for shake animation
    const style = document.createElement("style");
    style.innerHTML = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        .shake-input {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
            border-color: #e74c3c !important;
        }

        .input-focus label {
            color: #3498db;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s ease-in-out infinite;
            vertical-align: middle;
            margin-right: 5px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
});

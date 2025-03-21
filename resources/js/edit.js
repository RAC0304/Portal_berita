document.addEventListener("DOMContentLoaded", function () {
    // Deteksi apakah ini form edit atau create
    const form = document.querySelector("form");
    if (!form) {
        console.error("Form tidak ditemukan!");
        return;
    }

    const isEditForm = form.getAttribute("action").includes("edit");

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
        // Check if there's an existing image (only for edit form)
        const existingImage = isEditForm
            ? document.querySelector(".current-image img")
            : null;

        if (existingImage) {
            // Style the existing image container
            const imageContainer = document.createElement("div");
            imageContainer.className = "current-image";

            const imageLabel = document.createElement("span");
            imageLabel.className = "current-image-label";
            imageLabel.textContent = "Gambar Saat Ini";

            // Wrap the image in a container
            if (existingImage.parentNode) {
                existingImage.parentNode.insertBefore(
                    imageContainer,
                    existingImage
                );
                imageContainer.appendChild(existingImage);
                imageContainer.appendChild(imageLabel);

                // Add "remove image" option
                const imageActions = document.createElement("div");
                imageActions.className = "image-actions";

                const removeButton = document.createElement("button");
                removeButton.type = "button";
                removeButton.className = "remove-image";
                removeButton.innerHTML =
                    '<i class="fas fa-trash"></i> Hapus Gambar';
                removeButton.addEventListener("click", function () {
                    // Buat input tersembunyi untuk memberi tahu server bahwa gambar harus dihapus
                    const removeInput = document.createElement("input");
                    removeInput.type = "hidden";
                    removeInput.name = "remove_gambar";
                    removeInput.value = "1";

                    // Tambahkan input ke form
                    if (form) {
                        form.appendChild(removeInput);
                    } else {
                        console.error("Form tidak ditemukan!");
                    }

                    // Sembunyikan gambar dan tampilkan pesan
                    imageContainer.style.transition = "all 0.5s ease";
                    imageContainer.style.opacity = "0";
                    imageContainer.style.transform = "scale(0.8)";

                    setTimeout(() => {
                        imageContainer.style.display = "none";
                    }, 500);

                    // Tampilkan pesan bahwa gambar akan dihapus
                    const removeMessage = document.createElement("div");
                    removeMessage.className = "alert alert-warning";
                    removeMessage.style.marginTop = "10px";
                    removeMessage.textContent =
                        "Gambar akan dihapus setelah form disubmit";

                    if (fileInput.parentNode) {
                        fileInput.parentNode.insertBefore(
                            removeMessage,
                            fileInput
                        );
                    } else {
                        console.error(
                            "Parent node dari fileInput tidak ditemukan!"
                        );
                    }
                });

                imageActions.appendChild(removeButton);
                imageContainer.appendChild(imageActions);

                // Add entrance animation for existing image
                existingImage.style.opacity = "0";
                existingImage.style.transform = "scale(0.9)";
                existingImage.style.transition = "all 0.5s ease";

                setTimeout(() => {
                    existingImage.style.opacity = "1";
                    existingImage.style.transform = "scale(1)";
                }, 300);
            } else {
                console.error(
                    "Parent node dari existingImage tidak ditemukan!"
                );
            }
        }

        const fileUploadContainer = document.createElement("div");
        fileUploadContainer.className = "file-upload";

        const fileLabel = document.createElement("label");
        fileLabel.className = "file-upload-label";
        fileLabel.innerHTML =
            '<i class="fas fa-cloud-upload-alt"></i> ' +
            (isEditForm ? "Ganti Gambar" : "Pilih Gambar");
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
        if (originalParent) {
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
            const newFileInput =
                originalParent.querySelector('input[type="file"]');
            if (newFileInput) {
                newFileInput.addEventListener("change", function (e) {
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

                                // If there's an existing image container, add a "will be replaced" message
                                const existingImageContainer =
                                    originalParent.querySelector(
                                        ".current-image"
                                    );
                                if (
                                    existingImageContainer &&
                                    existingImageContainer.style.display !==
                                        "none"
                                ) {
                                    const replaceMessage =
                                        document.createElement("div");
                                    replaceMessage.className =
                                        "alert alert-info";
                                    replaceMessage.style.marginTop = "10px";
                                    replaceMessage.textContent =
                                        "Gambar saat ini akan diganti dengan gambar baru";

                                    // Remove previous message if exists
                                    const prevMessage =
                                        originalParent.querySelector(
                                            ".alert.alert-info"
                                        );
                                    if (prevMessage) {
                                        prevMessage.remove();
                                    }

                                    originalParent.insertBefore(
                                        replaceMessage,
                                        previewContainer
                                    );
                                }
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
            } else {
                console.error("New file input tidak ditemukan!");
            }
        } else {
            console.error("Parent node dari fileInput tidak ditemukan!");
        }
    }

    // Form validation and submission animations
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
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML =
                        '<span class="spinner"></span> ' +
                        (isEditForm ? "Updating..." : "Menyimpan...");
                    submitBtn.disabled = true;

                    // For demo purposes, we'll add the animation here
                    // In a real app, this would be handled by the server response
                    if (window.location.href.includes("demo")) {
                        e.preventDefault();
                        setTimeout(() => {
                            submitBtn.innerHTML =
                                '<i class="fas fa-check"></i> ' +
                                (isEditForm
                                    ? "Updated!"
                                    : "Berhasil Disimpan!");
                            submitBtn.style.backgroundColor = "#2ecc71";

                            setTimeout(() => {
                                if (!isEditForm) {
                                    form.reset();
                                }
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                                submitBtn.style.backgroundColor = isEditForm
                                    ? "#f39c12"
                                    : "#3498db";

                                // Reset file input display if not in edit mode
                                if (!isEditForm) {
                                    const fileName =
                                        document.querySelector(".file-name");
                                    if (fileName) {
                                        fileName.textContent =
                                            "Tidak ada file yang dipilih";
                                    }

                                    const previewContainer =
                                        document.querySelector(
                                            ".preview-container"
                                        );
                                    if (previewContainer) {
                                        previewContainer.style.display = "none";
                                    }
                                }
                            }, 2000);
                        }, 1500);
                    }
                } else {
                    console.error("Tombol submit tidak ditemukan!");
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
            color: ${isEditForm ? "#f39c12" : "#3498db"};
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

        /* Style for alerts */
        .alert {
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alert-warning {
            background-color: #fcf8e3;
            border: 1px solid #faebcc;
            color: #8a6d3b;
        }

        .alert-info {
            background-color: #d9edf7;
            border: 1px solid #bce8f1;
            color: #31708f;
        }
    `;
    document.head.appendChild(style);
});

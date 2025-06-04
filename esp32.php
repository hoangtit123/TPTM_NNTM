<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhận Diện Biển Số Xe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            max-width: 640px;
        }

        img {
            width: 100%;
            max-width: 640px;
            height: auto;
            border: 2px solid #ddd;
            margin-top: 10px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Nhận Diện Biển Số Xe</h1>
        <button id="capture-btn">Chụp Ảnh & Nhận Diện</button>
        <div id="image-container">
            <img id="snapshot" src="" alt="Ảnh sẽ hiển thị tại đây">
        </div>
        <div id="result-container" class="result"></div>
    </div>

    <script>
        const captureBtn = document.getElementById("capture-btn");
        const snapshotImg = document.getElementById("snapshot");
        const resultContainer = document.getElementById("result-container");

        captureBtn.addEventListener("click", () => {
            // Hiển thị trạng thái đang xử lý
            resultContainer.innerHTML = "<p>Đang chụp ảnh và nhận diện...</p>";

            // Gửi yêu cầu đến PHP để chạy file Python
            fetch("esp32_cam.php", { method: "POST" })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        // Hiển thị ảnh từ đường dẫn
                        snapshotImg.src = data.image_path;
                        snapshotImg.alt = "Ảnh nhận diện biển số";
                        resultContainer.innerHTML = `<p>Biển số xe: <strong>${data.plates.join(", ")}</strong></p>`;
                    } else {
                        // Hiển thị lỗi
                        resultContainer.innerHTML = `<p class="error">Lỗi: ${data.message}</p>`;
                    }
                })
                .catch(error => {
                    // Hiển thị lỗi kết nối
                    console.error("Lỗi:", error);
                    resultContainer.innerHTML = `<p class="error">Đã xảy ra lỗi khi xử lý yêu cầu.</p>`;
                });
        });
    </script>
</body>

</html>

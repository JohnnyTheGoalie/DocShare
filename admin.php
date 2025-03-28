<?php


// CHANGE PASSWORD HERE
$valid_username = 'admin'; // Set your desired username
$valid_password = 'admin'; // Set your desired password

// Check if the user has entered the correct credentials
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $valid_username || $_SERVER['PHP_AUTH_PW'] != $valid_password) {
    // If not, ask for credentials
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Restricted"');
    echo 'Access denied. Please provide a valid username and password.';
    exit;
}


if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1' && $_SERVER['REMOTE_ADDR'] !== '::1') {
    die("Access denied: You are not allowed to access this page.");
}

include 'db_connection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postavi dokument</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            background: #f4f4f4;
            padding: 20px;
        }
        h2 { color: #333; margin-top: 50px; }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            margin: auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        button:hover {
            background: #218838;
        }
        #drop-area {
            border: 2px dashed #ccc;
            padding: 40px;
            margin-top: 20px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.3s, height 0.3s;
        }
        #drop-area.highlight {
            background: #e3f2fd;
            border-color: #007bff;
            height: 160px;
        }
        #success-message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
            display: none;
            opacity: 0;
            transition: opacity 0.5s;
        }
        
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .nav-button {
            background: #FFFFFF;
            color: #007bff;
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
            box-shadow: none;
        }
            .nav-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    
    <a href="index.php" class="nav-button">Citaj dokument</a>

    <h2>Postavi dokument</h2>

    <form id="uploadForm">
        <input type="file" id="fileInput">
        <textarea id="textInput" placeholder="Ili ovde..."></textarea>
        <button type="submit">Upload</button>
    </form>

    <div id="drop-area">
        <p>Drag & Drop ovde</p>
    </div>

    <p id="success-message">✅ Uspešno postavljeno!</p>

    <script>
        document.getElementById("uploadForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData();
            const file = document.getElementById("fileInput").files[0];
            const text = document.getElementById("textInput").value.trim();

            if (text) {
                formData.append("textInput", text);
            } else if (file) {
                formData.append("file", file);
            } else {
                alert("Please upload a file or enter text.");
                return;
            }

            fetch("upload.php", {
                method: "POST",
                body: formData
            }).then(response => response.text()).then(data => {
                document.getElementById("success-message").style.display = "block";
                setTimeout(() => {
                    document.getElementById("success-message").style.opacity = 1;
                }, 100);
                console.log(data); 
            });
        });

        const dropArea = document.getElementById("drop-area");

        ["dragenter", "dragover"].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropArea.classList.add("highlight");
            });
        });

        ["dragleave", "drop"].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove("highlight"));
        });

        dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            document.getElementById("fileInput").files = e.dataTransfer.files;
        });
    </script>

</body>
</html>

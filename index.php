<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        h2 { color: #333; margin-top: 50px; }
        #viewer {
            white-space: pre-wrap;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 90%;
            width: 700px;
            margin: auto;
            text-align: left;
            font-size: 18px;
            line-height: 1.6;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
        
        .nav-button {
            background: #FFFFFF;
            color: #007bff;
            padding: 6px 12px; /* Smaller padding */
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px; /* Smaller font size */
            position: absolute; /* Push to the right */
            top: 20px;
            right: 20px; /* Positioning it to the right */
            text-decoration: none;
            box-shadow: none; /* Remove shadow to make it less prominent */
        }
            .nav-button:hover { /* Button hover effect */
            background: #0056b3;
        }
    </style>
</head>
<body>
    <a href="admin.php" class="nav-button">Postavi dokument</a>
    
    <h2>Trenutni dokument</h2>

    <div id="viewer">
        <?php
        if (file_exists('filetype.txt')) {
            $type = trim(file_get_contents('filetype.txt'));

            if ($type === 'pdf' && file_exists('document.pdf')) {
                echo "<iframe src='document.pdf'></iframe>";
            } elseif (file_exists('document.txt')) {
                echo nl2br(htmlspecialchars(file_get_contents('document.txt')));
            } else {
                echo "No document available.";
            }
        } else {
            echo "No document available.";
        }
        ?>
    </div>

    <script>
        function fetchText() {
            fetch("filetype.txt")
                .then(response => response.text())
                .then(type => {
                    if (type.trim() === 'pdf') return;
                    return fetch("document.txt");
                })
                .then(response => response ? response.text() : "")
                .then(text => {
                    if (text) document.getElementById("viewer").innerHTML = text.replace(/\n/g, "<br>");
                });
        }
        setInterval(fetchText, 3000);
    </script>
</body>
</html>

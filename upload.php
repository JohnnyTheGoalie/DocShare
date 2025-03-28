<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['textInput'])) {
        file_put_contents('document.txt', $_POST['textInput']);
        file_put_contents('filetype.txt', 'text');  // Mark as text
        echo "Text submitted successfully!";
    } elseif (!empty($_FILES['file']['name'])) {
        $file = $_FILES['file'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        if ($ext === 'txt') {
            move_uploaded_file($file['tmp_name'], 'document.txt');
            file_put_contents('filetype.txt', 'text');
            echo "Text file uploaded!";
        } elseif ($ext === 'docx') {
            $text = extractTextFromDocx($file['tmp_name']);
            file_put_contents('document.txt', $text);
            file_put_contents('filetype.txt', 'text');
            echo "Word document uploaded!";
        } elseif ($ext === 'pdf') {
            move_uploaded_file($file['tmp_name'], 'document.pdf');
            file_put_contents('filetype.txt', 'pdf');
            echo "PDF uploaded!";
        } else {
            echo "Unsupported file type!";
        }
    }
}

function extractTextFromDocx($filePath) {
    $zip = new ZipArchive;
    $text = "";
    if ($zip->open($filePath) === TRUE) {
        $xml = $zip->getFromName('word/document.xml');
        $zip->close();
        $xml = str_replace('</w:p>', "\n\n", $xml);
        $text = strip_tags($xml);
    }
    return $text ?: "Error reading DOCX.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Proses File</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      color: #000;
    }
    .card {
      border: 1px solid #000;
    }
    pre {
      background-color: #f8f9fa;
      border: 1px solid #000;
    }
  </style>
</head>
<body>

<div class="container w-50 mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h2 class="card-title text-center mb-4">Hasil Proses File</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keyword = $_POST['keyword'];
    $operation = $_POST['operation'];
    $outputType = $_POST['outputType'];

    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo '<div class="alert alert-danger border-dark">File upload gagal.</div>';
        exit;
    }

    $uploadedFile = $_FILES['file']['tmp_name'];
    $originalName = $_FILES['file']['name'];
    $fileLines = file($uploadedFile);
    $processedLines = [];

    echo '<h4 class="mb-3">Baris yang cocok:</h4>';
    echo '<pre class="p-3 rounded">';

    foreach ($fileLines as $line) {
        if (stripos($line, $keyword) !== false) {
            if ($operation === "redact") {
                $line = str_ireplace($keyword, "***", $line);
            }
            echo htmlspecialchars($line);
        }
        $processedLines[] = $line;
    }

    echo '</pre>';

    if ($operation === "redact") {
        $outputContent = implode("", $processedLines);

        if ($outputType === "O") {
            file_put_contents($uploadedFile, $outputContent);
            echo "<div class='alert alert-info border-dark mt-3'>Perubahan disimpan di file yang sama (sementara): <strong>{$originalName}</strong></div>";
        } elseif ($outputType === "N") {
            $info = pathinfo($originalName);
            $newName = $info['filename'] . "-new." . $info['extension'];
            file_put_contents($newName, $outputContent);
            echo "<div class='alert alert-success border-dark mt-3'>Perubahan disimpan sebagai file baru: <a href='$newName' download class='link-dark'><strong>$newName</strong></a></div>";
        }
    }
} else {
    echo '<div class="alert alert-danger border-dark">Akses tidak valid.</div>';
}
?>

      <div class="mt-4 text-center">
        <a href="file.php" class="btn btn-outline-dark">Kembali ke Form</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
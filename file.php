<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pencarian/Redact File</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      color: #000;
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container mt-5 w-50">
  <div class="card shadow-sm border-dark">
    <div class="card-body">
      <h2 class="card-title text-center mb-4">Form Search / Redact File</h2>
      <form action="proses.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Kata Kunci:</label>
          <input type="text" class="form-control border-dark" name="keyword" required>
        </div>

        <div class="mb-3">
          <label class="form-label">File:</label>
          <input type="file" class="form-control border-dark" name="file" accept=".txt,.html" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Operasi:</label>
          <select class="form-select border-dark" name="operation" required>
            <option value="search">Search</option>
            <option value="redact">Redact</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label">Tipe Keluaran:</label>
          <select class="form-select border-dark" name="outputType" required>
            <option value="O">Overwrite (file lama)</option>
            <option value="N">New File (file baru)</option>
          </select>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-dark px-4">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
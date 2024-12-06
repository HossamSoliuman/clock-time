<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Zone Data</title>
</head>
<body>
<h1>Upload Zone Data</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('upload-zone.file') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file">Choose an Excel file (.xlsx or .xls):</label>
    <input type="file" name="file" accept=".xlsx, .xls" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>

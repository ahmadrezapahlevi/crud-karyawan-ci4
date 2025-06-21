<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>crud karyawan</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <style>
    html, body{
      height: 100;
    },
    body{
      display: flex;
      flex-direction: column;
    },
  </style>
</head>
<body class="bg-body-tertiary">
  <?= $this->include('layouts/navbar'); ?>
  
  <div class="container py-5">
    <?= $this->renderSection('content'); ?>
  </div>
  
  <footer class="footer mt-auto py-3 bg-secondary">
  <div class="container text-center">
    <span class="text-white">
      Copyright &copy; 2025 - PiiCODE
    </span>
  </div>
</footer>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?= $this->renderSection('custom_js'); ?>
</body>
</html> 
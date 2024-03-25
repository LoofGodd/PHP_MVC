<?php
include_once __DIR__ . '/../utils/queryParams.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php echo $pageTitle ?>
    </title>
    <link rel="stylesheet" href="<?php echo'/app/views/styles/bootstrap/css/bootstrap.min.css' ?>" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <script src="<?php echo __DIR__ . '/styles/bootstrap/js/bootstrap.min.js' ?>"></script>
    <style>
        .marquee {
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
}

.marquee span {
  display: inline-block;
  animation: marquee 30s linear infinite;
}

@keyframes marquee {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}
    </style>
</head>

<body>
    <header>
        <div class='bg-warning'>
            <div class='fs-3 marquee'>
                <span>
                    <?php echo $run_string ?>
                </span>
            </div>
        </div>
        <div class="my-5">
            <h1 class="text-uppercase display-1 fw-bold text-center">
                <a href='/' class="text-success text-decoration-none" style="text-underline-offset: none;">
                    "<span class="text-primary m-0">M</span>
                    <span class="text-info">V</span> <span class="text-warning">C</span>"
                </a>
                project
            </h1>
        </div>
    </header>

    <!-- Main content section -->
    <main >
        <?php include $contentView; ?>
    </main>

    <!-- Footer section -->
    <footer class='vw-100 p-4 text-center'>
        <h6 class='text-secondary'>&copy;copyright Chorn D. Bunnarot</h6>
    </footer>
    <script src='/app/views/styles/bootstrap/js/bootstrap.bundle.min.js'></script>
</body>

</html>

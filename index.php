<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
    <link rel="stylesheet" href="./assets/style/output.css">
    <link href="./node_modules/flowbite/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>

<body class="bg-[#1d1d1d]">
    <section class="text-white flex min-h-screen">
        <!-- Sidebar -->
        <?php include('./includes/sidebar.php'); ?>

        <!-- Main Content -->
        <div class="w-full">
            <?= isset($content) ? $content : include("./includes/hero.php"); ?>
        </div>
    </section>
    <script src="./assets/js/script.js"></script>
    <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>
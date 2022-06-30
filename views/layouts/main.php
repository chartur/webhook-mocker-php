<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/all.min.css">
</head>
<body>
    <?php $this->getSection("gexec") ?>
    
    <div class="app-content">
        <?php $this->import("components.header") ?>
        <div class="router-content">
            <div class="container">
              <?php $this->getSection("content") ?>
            </div>
        </div>
        <?php $this->import("components.footer") ?>
    </div>

    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/rxjs.js"></script>
    <?php $this->getSection("scripts") ?>
</body>
</html>
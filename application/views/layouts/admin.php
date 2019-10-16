<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="/public/css/admin.css">

    <title><?php echo $title; ?> | Admin</title>
</head>
<body>

    <header>
        <div class="container">
            <div class="logo">
                SITE.com
            </div>

            <button id="menu-toggle">MENU</button>
            <nav id="menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/posts">Posts</a></li>
                    <li><a href="/contact">Contacts</a></li>
                    <li><a href="/admin/add">+ New</a></li>
                    <li><a href="/admin/posts">Posts</a></li>
                    <li><a href="/admin/stars">Starred</a></li>
                    <li><a href="/admin/logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </main>




    <!-- Scripts -->
    <script src="/public/js/script.js"></script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/form.js"></script>
</body>
</html>

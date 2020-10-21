<?php
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$session = $data['session_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jivo Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<main class="py-4">
    <div class="container" id="app">
        <?php
        if (!empty($session)) {
            ?>
            <h1>You are already logged in</h1>
        <?php
        }
        else {?>
            <p class="bg-danger" v-if="errors.length">
                <b>Please correct the indicated errors:</b>
            <ul>
                <li class="text-danger" v-for="error in errors">{{ error }}</li>
            </ul>
            </p>
            <form v-on:submit="login" action="#" method="post">
                <div class="form-group mx-sm-3 mb-2">
                    <label class="sr-only" for="name">Login</label>
                    <input v-model="name" name="name" class="form-control" placeholder="Enter login">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label class="sr-only" for="email">Password</label>
                    <input v-model="password" type="password" name="email" class="form-control" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary mx-sm-3 mb-2">Login</button>
            </form>
        <?php
        }
        ?>
    </div>
</main>
<script src="/public/js/main.js"></script>
</body>
</html>

<?php
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$userAuth= !empty($data['session_id']) ? true : false;
$session = $data['session_id'];

if (empty($session)) {
        header("Location: http://jivoplayer.ru/login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Advertising Manager</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<main class="py-4">
    <div class="container" id="app">
        <a href="/logout">Logout</a>
        <a href="/public/media/jivo.zip">Download plugin</a>
        <p class="bg-danger" v-if="errors.length">
            <b>Please correct the indicated errors:</b>
        <ul>
            <li class="text-danger" v-for="error in errors">{{ error }}</li>
        </ul>
        </p>
        <form v-on:submit="add_task" action="#" method="post"  class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label class="sr-only" for="name">Name</label>
                <input type="text" v-model="name" name="name" class="form-control" placeholder="Enter name">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="sr-only" for="file">File</label>
                <input type="file" ref="file" @change="handleFileUpload">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="sr-only" for="link">Link</label>
                <input type="text" v-model="link" name="link" class="form-control" placeholder="Enter link">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="sr-only" for="often">Often</label>
                <input type="number" v-model="often" name="often" class="form-control" placeholder="Enter often">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="sr-only" for="unique">Unique</label>
                <input type="number" v-model="unique" name="unique" class="form-control" placeholder="Enter unique">
            </div>
            <button type="submit" class="btn btn-primary mx-sm-3 mb-2">Add advertising</button>
        </form>
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>file</th>
                <th>link</th>
                <th>often</th>
                <th>unique</th>
                <th>edit</th>
<!--                <th><button @click="changeToggle()">Edit</button></th>-->
            </tr>
            </thead>
            <tbody>

            <tr v-for="task in tasks">
                <td :id="task.id">
                    <p v :class="{ hidden : active_el == task.id }">{{ task.name }}</p>
                    <input :class="{ unhidden : active_el == task.id }" v-show='toggleEdit' type="text" v-model="task.name">
                </td>
                <td>
                    <p  :class="{ hidden : active_el == task.id }">{{ task.file }}</p>
                    <input :class="{ unhidden : active_el == task.id }" v-show='toggleEdit' readonly type="text" v-model="task.file">
                </td>
                <td>
                    <p  :class="{ hidden : active_el == task.id }">{{ task.link }}</p>
                    <input :class="{ unhidden : active_el == task.id }" v-show='toggleEdit' type="text" v-model="task.link">
                </td>
                <td>
                    <p :class="{ hidden : active_el == task.id }">{{ task.often }}</p>
                    <input :class="{ unhidden : active_el == task.id }" v-show='toggleEdit' type="number" v-model="task.often">
                </td>
                <td>
                    <p  :class="{ hidden : active_el == task.id }">{{ task.uniq }}</p>
                    <input :class="{ unhidden : active_el == task.id }" v-show='toggleEdit' type="number" v-model="task.uniq">
                </td>
                <td class="task-edit">
                    <button :class="{ hidden : active_el == task.id }" @click="activate(task.id)">Edit</button>
                    <button :class="{ unhidden : active_el == task.id }"
                            @click="edit(task.id, task.name, task.file, task.link, task.often, task.uniq)">Done</button>
                </td>
                <td><button @click="deleteTask(task.id)">Delete</button></td>
            </tr>
            </tbody>
        </table>

<!--        <button class="btn btn-primary mx-sm-3 mb-2" :disabled="currPage==1" @click="prevPage">-->
<!--            Previous-->
<!--        </button>-->
<!--        <button class="btn btn-primary mx-sm-3 mb-2" :disabled="currPage >= pages"  @click="nextPage">-->
<!--            Next-->
<!--        </button>-->
    </div>
</main>
<script type="text/javascript" src="/public/js/main.js"></script>
</body>
</html>

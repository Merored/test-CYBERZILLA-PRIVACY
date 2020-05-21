<template>
    <div>             
        <div class="form-group">
            <router-link :to="{name: 'tasksCreate', params: {user_id:$route.params.id}}" class="btn btn-success">Создать задачу</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Задачи на сегодня</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Задача</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="task in tasks" :key="task.id">
                        <td>{{ task.title }}</td>
                        <td>{{ task.description }}</td>
                        <td>{{ task.status }}</td>
                        <td>
                            <router-link :to="{name: 'tasksEdit', params: {user_id:$route.params.id, id: task.id}}" class="btn btn-xs btn-primary">
                                Изменить
                            </router-link>
                        </td>
                        <td>
                            <a href="#"
                            class="btn btn-xs btn-danger"
                            v-on:click="deleteEntry(task.id)">
                                Удалить
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</template>
 
<script>
    import TasksCreate from './TasksCreate.vue';
    import TasksEdit from './TasksEdit.vue';
    export default {
        components: {
            TasksCreate,
            TasksEdit
        },
        data: function () {
            return {
                userId:'',
                tasks: []
            }
        },
        mounted() {          
            this.loadTasks()
        },
        methods: {
            loadTasks(){
                var app = this;
                app.userId = app.$route.params.id
                axios.get('/users/'+app.userId+'/todos')
                .then(function (resp) {
                    app.tasks = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                });
            },
            deleteEntry(id) {
                if (confirm("Вы действительно хотите удалить задачу №" + id)) {
                    var app = this;
                    axios.delete('/users/'+app.userId+'/todos/' + id)
                    .then(function (resp) {
                        app.loadTasks()
                        alert("Задача успешно удалена");
                    })
                    .catch(function (resp) {
                        alert("Не удалось удалить задачу");
                    });
                }
            }
        }
    }
</script>
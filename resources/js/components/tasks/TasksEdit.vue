<template>
    <div>
        <div class="card-header">Изменить задачу №{{task.id}}</div>

        <div class="card-body">
            <div class="form-group">
                <router-link :to="'/users/'+$route.params.user_id+'/edit?show_tasks=true'" class="btn btn-primary">Назад</router-link>
            </div>                   
            <div class="panel panel-default" >                
                <div class="panel-body">
                    <form v-on:submit="saveForm()">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Название</label>
                                <input type="text" v-model="task.title" class="form-control w-100p">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Описание</label>
                                <textarea v-model="task.description" class="form-control w-100p"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Дата окончания</label>
                                <input type="date" v-model="task.date" class="form-control w-100p">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Статус</label>
                                <input type="text" v-model="task.status" class="form-control w-100p">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12` form-group">
                                <button class="btn btn-success">Изменить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            let app = this;
            let userId = app.$route.params.user_id;
            let id = app.$route.params.id;
            axios.get('/users/'+userId+'/todos/' + id)
            .then(function (resp) {
                app.task = resp.data;
            })
            .catch(function () {
                alert("Не удалось загрузить данные задачи")
            });
        },
        data: function () {
            return {
                task:{},
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var task = app.task;
                let userId = app.$route.params.user_id;
                let id = app.$route.params.id;
                axios.put('/users/'+userId+'/todos/' + id, task)
                .then(function (resp) {
                    app.$router.push('/users/'+app.$route.params.user_id+'/edit?show_tasks=true');
                    alert("Задача обновлена");
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось обновить задачу");
                });
            }
        }
    }
</script>

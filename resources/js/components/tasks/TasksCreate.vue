<template>
    <div>
        <div class="card-header">Изменить задачу №{{task.id}}</div>

        <div class="card-body">
            <div class="form-group">
                <router-link :to="'/users/'+$route.params.user_id+'/edit?show_tasks=true'" class="btn btn-primary">Назад</router-link>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><h2>Создать новую задачу</h2></div>
                <div class="panel-body">
                    <form v-on:submit="saveForm()">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Название задачи</label>
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
                                <label class="control-label">Дата задачи</label>
                                <input type="date" v-model="task.date" class="form-control w-100p">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12` form-group">
                                <button class="btn btn-success">Создать</button>
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
        data: function () {
            return {
                task: {  
                    title: '', 
                    description: '',  
                    date: '',  
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newtask = app.task;
                let userId = app.$route.params.user_id;
                newtask.user_id = userId 
                axios.post('users/'+userId+'/todos/', newtask)
                .then(function (resp) {
                    app.$router.push({path: '/users/'+app.$route.params.user_id+'/edit?show_tasks=true'});
                    alert("Задача успешно создана");
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось создать задачу");
                });
            }
        }
    }
</script>
<style >
.w-100p {
    width: 100%;
}
</style>
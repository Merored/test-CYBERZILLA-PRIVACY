<template>
    <div>
        <div class="card-header">Пользователь №{{user.id}}</div>

        <div class="card-body">
            <div class="form-group">
                <router-link to="/" class="btn btn-primary">Назад</router-link>
            </div>
        
            <div class="tabs">
                <div class="tab" v-bind:class="{ active: !editTabHidden }" @click="taskTabHidden = true; editTabHidden = false;">
                    Редакетирование
                </div>
                <div class="tab" v-bind:class="{ active: !taskTabHidden }" @click="editTabHidden = true; taskTabHidden = false;"> 
                    Список задач
                </div>
            </div>                            
            <div class="panel panel-default" :hidden='editTabHidden'>                
                <div class="panel-body">
                    <form v-on:submit="saveForm()">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Имя</label>
                                <input type="text" v-model="user.name" class="form-control w-100p">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Телефон</label>
                                <textarea v-model="user.phone" class="form-control w-100p"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">E-mail</label>
                                <input type="email" v-model="user.email" class="form-control w-100p">
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
            <div :hidden='taskTabHidden'>                
                <tasks-list ></tasks-list>
            </div>            
        </div>
    </div>
</template>
<script>
    import TasksList from '../tasks/TasksList.vue';
 
    export default {
        components: {
            TasksList
        },
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.userId = id;
            axios.get('/users/' + id)
            .then(function (resp) {
                app.user = resp.data;
            })
            .catch(function () {
                alert("Не удалось загрузить данные пользователя")
            });
            if (app.$route.query.show_tasks) {
                app.editTabHidden = true
                app.taskTabHidden = false
            }
        },
        data: function () {
            return {
                editTabHidden: false,
                taskTabHidden: true,
                userId: null,
                user:{},
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var user = app.user;
                axios.patch('/users/' + app.userId, user)
                .then(function (resp) {
                    app.$router.replace('/');
                    alert("Данные пользователя обновлены");
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось обновить пользователя");
                });
            }
        }
    }
</script>
<style >
.tabs {
    border-bottom: 1px solid #ccc;
    margin-bottom: 30px;
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
}
.tab {
    cursor: pointer;
    padding: 10px 20px 10px 20px;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}
.tab.active{
    color:#38c172;
}
</style>
<template>
    <div>
        <div class="card-header">Создать пользователя</div>

        <div class="card-body">
        
            <div class="form-group">
                <router-link to="/" class="btn btn-primary">Назад</router-link>
            </div>

            <div class="panel panel-default">
               
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
                                <input v-model="user.phone" class="form-control w-100p">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">E-mail</label>
                                <input type="email" v-model="user.email" class="form-control w-100p">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                <label class="control-label">Пароль</label>
                                <input type="password" v-model="user.password" class="form-control w-100p">
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
                user: {  
                    name: '', 
                    phone: '',  
                    email: '',  
                    password:''
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newUser = app.user;
                axios.post('/users', newUser)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                        alert("Пользователь успешно создан");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Не удалось создать пользователя");
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
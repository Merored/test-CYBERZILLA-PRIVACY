<template>
    
    <div>
        <div class="card-header">Пользователи</div>

        <div class="card-body">
                  
             
            <div class="form-group">
                <router-link :to="{name: 'usersCreate'}" class="btn btn-success">Создать пользователя</router-link>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">Пользователи</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>E-mail</th>                    
                            <th>Телефон</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in pageOfItems" :key="user.id">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.phone }}</td>
                            <td>
                                <router-link :to="{name: 'usersEdit', params: {id: user.id}}" class="btn btn-xs btn-primary">
                                    Изменить
                                </router-link>
                            </td>
                            <td>
                                <a href="#"
                                class="btn btn-xs btn-danger"
                                v-on:click="deleteEntry(user.id, index)">
                                    Удалить
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <jw-pagination :items="users" @changePage="onChangePage"></jw-pagination>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                users: [],
                pageOfItems: [],
            }
        },
        mounted() {
            this.loadUsers()
        },
        methods: {
            onChangePage(pageOfItems) {
                this.pageOfItems = pageOfItems;
            },
            loadUsers() {
                var app = this;
                axios.get('/users', {'page': this.page})
                .then(function (resp) {
                    app.users = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);                    
                });
            },
            deleteEntry(id, index) {
                if (confirm("Вы уверены что хотите удалить пользователя №" + id)) {
                    var app = this;
                    axios.delete('/users/' + id)
                    .then(function (resp) {
                        app.loadUsers()
                        alert("Пользователь успешно удалён");
                    })
                    .catch(function (resp) {
                        alert("Не удалось удалить пользователя");
                    });
                }
            }
        }
    }
</script>
<style >
.panel-footer {
    display: flex;
    justify-content: center;
}
</style>
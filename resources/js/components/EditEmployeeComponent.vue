<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary" >
                <form method ="POST" action = "" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Имя</label>
                            <input type="text" class="form-control" id="inputName" name = "name" v-model="employee.name">
                        </div>
                        <div class="form-group">
                            <label for="inputSurname">Фамилия</label>
                            <input type="text" class="form-control" id="inputSurname" name = "surname" v-model = "employee.surname" >
                        </div>
                        <div class="form-group">
                            <label for="inputPatronomic">Отчество</label>
                            <input type="text" class="form-control" id="inputPatronomic" name = "patronymic"  v-model = "employee.patronymic">
                        </div>
                        <div class="form-group" >
                            <label for="inputEmail">Номер телефона</label>
                            <input type="text" v-mask="'+7(999)999 99 99'" class="form-control" name = "phone" v-model = "employee.phone" />
                        </div>
                        <div class="form-group">
                            <label>Пол</label>
                            <select class="form-control" name = "gender" :required="true">
                                <option v-for="genOption in genOptions" value="" v-bind:selected="employee.gender=== genOption.gen" :value="genOption.value"> {{genOption.gen}}</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="inputEmail">Дата рождения</label>
                            <input class = "form-control" type="tel" v-mask="'##/##/####'"  name = "birth_date" placeholder="ДД/ММ/ГГГГ" v-model="employee.birth_date"/>
                        </div>
                        <div class="form-group" >
                            <input type="checkbox" id="checkbox"  v-model="hasAccount" name = "createUser" >
                            <label for="checkbox">Дать доступ к системе</label>
                            <transition name = "fade">
                                <div class="form-group" v-if="hasAccount">
                                    <label for="inputEmail">Почта</label>
                                    <input type="email" class="form-control" id="inputEmail" name = "email" v-model="user.email">
                                </div>
                            </transition>
                            <transition name = "fade">
                                <div class="form-group" v-if="hasAccount">
                                    <label>Доступы</label>
                                    <div class="form-check" v-for="permission in permissions">
                                        <input name = "permissions[]" class="form-check-input" type="checkbox" value="" :checked="checkPermissions(permission)">
                                        <label class="form-check-label" v-text="permission.alias" > </label> <br>
                                    </div>
                                </div>

                            </transition>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            employee: {
                type: Object,
                required: true
            },

        },
        data(){
            return{
                roles: [],
                permissions:[],
                genOptions:[
                    {value:1, gen:"Не указано"},
                    {value:2, gen:"Мужской"},
                    {value:3, gen:"Женский"}
                ],
                hasAccount:false,
                user:{
                    type:Object
                },
                usersPermissions:[]

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.getRoles();
            this.checkAccount();
            this.getAllPermissions();
        },
        methods:{
            getRoles(){
                axios.get('/getroles').then(({data})=>this.roles = data);
            },
            getAllPermissions(){
                axios.get('/getpermissions').then(({data})=>this.permissions = data);
            },
            checkAccount(){
                if(this.employee.user_id!=" "){
                    this.hasAccount = true;
                    var id = this.employee.user_id;
                    axios.get('/getUserById/'+id).then(({data})=>this.user = data);
                    axios.get('/getPermissionsByUserId/'+id).then(({data})=>this.usersPermissions = data);
                    // this.$toaster.success('Your toaster success message.')
                }
            },
            checkPermissions(perm){
                for(var i =0;i<this.usersPermissions.length;i++){
                    if(this.usersPermissions[i].id == perm.id){
                        return true;
                    }
                }
                return false;
            }

        }
    }
</script>

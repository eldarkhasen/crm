<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary" >
                <form autocomplete="off" @submit.prevent="submit">
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
                            <select class="form-control" name = "gender" :required="true" v-model="employee.gender">
                                <option v-for="genOption in genOptions" v-bind:selected="employee.gender=== genOption.gen" :value = "genOption.gen"> {{genOption.gen}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Должности</label>
                            <!--<multiselect v-model="employeePositions" :options="positions" :multiple="true" :close-on-select="true" :clear-on-select="true" :preserve-search="true" track-by="name" ></multiselect>-->
                            <multiselect v-model="employeePositions" :options="positions" :multiple="true" :close-on-select="true" :clear-on-select="true"  placeholder="Выбери должность" label="name" track-by="name" :preselect-first="true" selectLabel="Нажмите чтобы выбрать" selectedLabel="Выбрано" deselectLabel="Нажмите чтобы убрать"></multiselect>

                        </div>

                        <div class="form-group">
                            <label>Услуги</label>
                            <!--<multiselect v-model="employeePositions" :options="positions" :multiple="true" :close-on-select="true" :clear-on-select="true" :preserve-search="true" track-by="name" ></multiselect>-->
                            <multiselect v-model="employeeServices" :options="services" :multiple="true" :close-on-select="true" :clear-on-select="true"  placeholder="Выбери Услуги" label="name" track-by="name" :preselect-first="true" selectLabel="Нажмите чтобы выбрать" selectedLabel="Выбрано" deselectLabel="Нажмите чтобы убрать"></multiselect>

                        </div>
                        <div class="form-group" >
                            <label for="color">Цвет</label>
                            <input class = "form-control" type="color" name = color id = "color" v-model="employee.color">
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
                                    <label for="inputPassword">Пароль</label>
                                    <input type="password" class="form-control" id="inputPassword" name = "password" v-model="user.password">
                                </div>
                            </transition>
                            <transition name = "fade">
                                <div class="form-group" v-if="hasAccount">
                                    <label>Доступы</label>
                                    <div class="form-check" v-for="permission in permissions">
                                        <input name = "permissions[]" class="form-check-input" type="checkbox" :value="permission"  v-model = "usersPermissions">
                                        <label class="form-check-label" v-text="permission.alias" > </label> <br>
                                    </div>
                                </div>

                            </transition>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
                positions:[],
                services:[],
                genOptions:[
                    {value:1, gen:"Не указано"},
                    {value:2, gen:"Мужской"},
                    {value:3, gen:"Женский"}
                ],
                hasAccount:false,
                user:{
                    type:Object
                },
                usersPermissions:[],
                employeePositions:[],
                employeeServices:[]

            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        created(){
            this.getRoles();
            this.checkAccount();
            this.getAllPermissions();
            this.getAllPositions();
            this.getEmpPositions();
            this.getAllServices();
            this.getEmpServices();
        },
        methods:{
            getRoles(){
                axios.get('/getroles').then(({data})=>this.roles = data);
            },
            getAllPermissions(){
                axios.get('/getpermissions').then(({data})=>this.permissions = data);
            },
            getAllPositions(){
                axios.get('/getpositions').then(({data})=>this.positions = data);
            },
            getEmpPositions(){
                var id  = this.employee.id;

                axios.get('/getpositionsByEmpId/'+id).then(({data})=>this.employeePositions = data);
            },
            getAllServices(){
                axios.get('/getServices').then(({data})=>this.services = data);
            },
            getEmpServices(){
                var id  = this.employee.id;

                axios.get('/getServicesByEmpId/'+id).then(({data})=>this.employeeServices = data);
            },
            checkAccount(){
                if(this.employee.user_id!=null){
                    this.hasAccount = true;
                    var id = this.employee.user_id;
                    axios.get('/getUserById/'+id).then(({data})=>this.user = data);
                    axios.get('/getPermissionsByUserId/'+id).then(({data})=>this.usersPermissions = data);

                }
            },
            submit(){
                if(this.hasAccount){
                    axios.put('/employees/'+this.employee.id,{
                        employee: this.employee,
                        permissions: this.usersPermissions,
                        hasAccount: this.hasAccount,
                        user: this.user,
                        positions: this.employeePositions,
                        services:this.employeeServices,
                    }).then(function (response) {
                        if(response.status === 200) {
                            window.location.href = '/employees';
                        }
                    });
                }else{
                    axios.put('/employees/'+this.employee.id,{
                        employee: this.employee,
                        hasAccount: this.hasAccount,
                        positions: this.employeePositions,
                        services:this.employeeServices,
                    }).then(function (response) {
                        if(response.status === 200) {
                            window.location.href = '/employees';
                        }
                    });
                }
            }

        }
    }
</script>

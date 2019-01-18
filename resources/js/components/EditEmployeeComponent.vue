<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary" >
                <form method ="POST" action = "" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Имя</label>
                            <input type="text" class="form-control" id="inputName" name = "name" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="inputSurname">Фамилия</label>
                            <input type="text" class="form-control" id="inputSurname" name = "surname" v-model = "surname">
                        </div>
                        <div class="form-group">
                            <label for="inputPatronomic">Отчество</label>
                            <input type="text" class="form-control" id="inputPatronomic" name = "patronymic" v-model = "patronymic">
                        </div>
                        <div class="form-group" >
                            <label for="inputEmail">Номер телефона</label>
                            <input type="text" v-mask="'+7(999)999 99 99'" class="form-control" name = "phone"  v-model="phone"/>
                        </div>
                        <div class="form-group">
                            <label>Пол</label>
                            <select class="form-control" name = "gender" :required="true">
                                <option v-for="genOption in genOptions" value="" v-bind:selected="gender=== genOption.gen" :value="genOption.value"> {{genOption.gen}}</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="inputEmail">Дата рождения</label>
                            <input class = "form-control" type="tel" v-mask="'##/##/####'"  name = "birth_date" placeholder="ДД/ММ/ГГГГ" v-model="birthdate"/>
                        </div>
                        <div class="form-group" >
                            <input type="checkbox" id="checkbox"  v-model="check" name = "createUser" >
                            <label for="checkbox">Дать доступ к системе</label>
                            <transition name = "fade">
                                <div class="form-group" v-if="check">
                                    <label for="inputEmail">Почта</label>
                                    <input type="email" class="form-control" id="inputEmail" name = "email">
                                </div>
                            </transition>
                            <transition name = "fade">
                                <div class="form-group" v-if="check">
                                    <label>Доступы</label>
                                    <div class="form-check" v-for="role in roles">
                                        <input name = "permissions[]" class="form-check-input" type="checkbox" value="">
                                        <label class="form-check-label" v-text="role.name"> </label> <br>
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
        props:{
          phone:"",
            hasUser:false,
            name:"",
            surname:"",
            patronymic:"",
            gender:"",
            birthdate:"",
        },
        data(){
            return{
                roles: [],
                genOptions:[
                    {value:1, gen:"Не указано"},
                    {value:2, gen:"Мужской"},
                    {value:3, gen:"Женский"}
                ],
                check:this.hasUser,

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.getRoles();

        },
        methods:{
            getRoles(){
                axios.get('/getroles').then(({data})=>this.roles = data);
            }
        }
    }
</script>

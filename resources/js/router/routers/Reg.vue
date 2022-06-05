<template>
    <div class="login">
        <div class="loginPanel">
            <h3>Регистрация</h3>
            <div>
                <p>{{ textlogin.name.text }}</p>
                <span :class="textlogin.name.class" class="tr-04"></span>
                <input type="text" v-model="name" placeholder="Царь">
            </div>
            <div>
                <p>{{ textlogin.login.text }}</p>
                <span :class="textlogin.login.class" class="tr-04"></span>
                <input type="text" @input="placeholderLoginRamdom()" v-debounce:700ms="loginCheck" v-model="login"
                    :placeholder="placeholderLogin">
            </div>
            <div>
                <p>{{ textlogin.password.text }}</p>
                <span :class="textlogin.password.class" class="tr-04"></span>
                <input type="password" v-model="password" @input="placeholderRamdom()" :placeholder="placeholder">
            </div>
            <button @click="reg()" v-if="!textlogin.allowedReg">Зарегистрироваться</button>

            <router-link to="/login">Войти?</router-link>


        </div>
    </div>
</template>
<script>
import { vue3Debounce } from 'vue-debounce'
export default {
    directives: {
        debounce: vue3Debounce()
    },
    data() {
        return {
            placeholder: '',
            placeholderLogin: '',
            login: '',
            textforlogin: '',
            textApi: '',
            password: '',
            name: ''
        }
    },
    computed: {
        textlogin() {
            let ps = ' '
            let lg = ' '
            let name = ' '
            let classname = ''
            let classlogin = ''
            let classpassword = ''
            let couterror = 0
            if (this.password.length == 0) {
                ps = 'Введите пароль'
                couterror++
            }
            else if (this.password.length < 6) {
                ps = 'Ваш пароль небезопасен'
                classpassword = 'loginPanelBad'
                couterror++
            }
            else {
                ps = 'Выполнено'
                classpassword = 'loginPanelGood'
            }



            if (this.login.length == 0) {
                lg = 'Введите логин'
                couterror++
            }
            else if (this.login.length < 6) {
                lg = 'Введите больше 5 символов'
                classlogin = 'loginPanelBad'
                couterror++
            }
            else if (this.textApi.length == 0) {
                lg = 'Идет проверка'
                classlogin = ''
            }
            else if (this.textApi == 'Логин занят') {
                lg = this.textApi
                classlogin = 'loginPanelBad'
                couterror++
            }
            else {
                lg = this.textApi
                classlogin = 'loginPanelGood'
            }

            if (this.name.length < 2) {
                name = 'Введите имя или псевдоним'
                classname = 'loginPanelBad'
                couterror++
            }
            else {
                name = 'Выполнено'
                classname = 'loginPanelGood'
            }


            return {
                name: {
                    text: name,
                    class: classname
                },
                login: {
                    text: lg,
                    class: classlogin
                },
                password: {
                    text: ps,
                    class: classpassword
                },
                allowedReg: couterror
            }


        }
    },
    mounted() {
        this.placeholderRamdom();
        this.placeholderLoginRamdom();
    },
    methods: {
        reg() {
            if (this.login.length < 6) {
                return 0
            }
            if (this.name.length < 2) {
                return 0
            }
            if (this.password.length < 6) {
                return 0
            }
            const form = new FormData()
            form.append('name', this.name)
            form.append('login', this.login)
            form.append('password', this.password)
            fetch('/api/reg', {
                method: 'POST',
                body: form
            })
                .then(r => {
                    if (r.status == 204) {
                        this.$router.push("/login");
                    }
                })
        },
        loginCheck() {
            const form = new FormData()
            form.append('login', this.login)
            fetch('/api/checklogin', {
                method: 'POST',
                body: form
            })
                .then(r => r.json()).then(r => {
                    if (r.data != null) {
                        this.textApi = r.data
                    }

                })
        },
        placeholderLoginRamdom() {
            this.placeholderLogin = Math.random().toString(36).slice(-8);
        },
        placeholderRamdom() {

            this.placeholder = Math.random().toString(36).slice(-8);
        }
    }
}
</script>
<style lang="scss" scoped>
.tr-04 {
    transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
}

.login {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    &Panel {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.1) 0 0 50px;
        background: white;

        &Bad {
            position: absolute;
            width: 50px;
            height: 50px;

            top: -5px;
            right: 0;
            transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
            transform: scale(0.7);

            &::after {
                content: "";
                position: absolute;
                width: 30px;
                height: 4px;
                background: red;
                transform: rotateZ(135deg);
                bottom: 19px;
                right: 0px;
                transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;

            }

            &::before {
                content: "";
                position: absolute;
                width: 30px;
                height: 4px;
                background: red;
                transform: rotateZ(225deg);
                bottom: 19px;
                right: 1px;
                transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
            }
        }

        &Good {
            position: absolute;
            width: 50px;
            height: 50px;
            top: -1px;
            right: -4px;
            transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
            transform: scale(0.7);

            &::after {
                content: "";
                position: absolute;
                width: 34px;
                height: 5px;
                background: green;
                transform: rotateZ(315deg);
                bottom: 21px;
                right: -1px;
                transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
            }

            &::before {
                content: "";
                position: absolute;
                width: 15px;
                height: 5px;
                background: green;
                transform: rotateZ(45deg);
                bottom: 15px;
                right: 23px;
                transition: cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
            }
        }

        a {
            padding: 5px 10px;
        }

        div {
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 5px 10px;
            position: relative;

            p {
                height: 18px;
                width: 100%;
            }

            input {
                padding: 0;
                border: none;
                border-radius: 0;
                font-weight: 500;
            }
        }
    }
}
</style>


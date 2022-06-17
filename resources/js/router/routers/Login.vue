<template>
    <div class="login">
        <div class="loginPanel">
            <h3>Вход</h3>
            <div>
                <p>{{ textlogin.text }}</p>
                <span :class="textlogin.class" class="tr-04"></span>
                <input type="text" @input="placeholderLoginRamdom()" v-debounce:400ms="loginCheck" v-model="login"
                    :placeholder="placeholderLogin">
            </div>
            <div>
                <p>{{ textlogin.password }}</p>
                <input type="password" v-model="password" @input="placeholderRamdom()" v-debounce:400ms="loginCheck"
                    :placeholder="placeholder">
            </div>
            <router-link to="/reg">Зарегистрироваться?</router-link>
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
            password: ''
        }
    },
    computed: {
        textlogin() {
            let ps = ''
            let lg = ''
            let classlg = ''
            if (this.password.length == 0) {
                ps = 'Введите пароль'
            }
            else if (this.password.length > 0) {
                if (this.password.length == 1) {
                    ps = 'вы ввели ' + this.password.length + ' символ'
                }
                if (this.password.length > 1 && this.password.length <= 4) {
                    ps = 'вы ввели ' + this.password.length + ' символа'
                }
                ps = 'вы ввели ' + this.password.length + ' символов'
            }
            if (this.login.length == 0) {
                lg = 'Введите логин'
            }
            else if (this.login.length < 6) {
                lg = 'Введите больше 5 символов'
                classlg = 'loginPanelBad'
            }
            else if (this.textApi.length == 0) {
                lg = 'Идет проверка'
                classlg = ''
            }

            else {
                lg = this.textApi
                classlg = 'loginPanelGood'
            }
            return { text: lg, class: classlg, password: ps }

        }
    },
    mounted() {
        this.placeholderRamdom();
        this.placeholderLoginRamdom();
    },
    methods: {

        loginCheck() {
            if (this.login.length < 6) {
                return 0
            }
            const form = new FormData()
            form.append('login', this.login)
            form.append('password', this.password)
            fetch('/api/checklogin', {
                method: 'POST',
                body: form
            })
                .then(r => r.json()).then(r => {
                    if (r.data != null) {
                        this.textApi = r.data
                    }
                    if (r.token != null) {
                        localStorage.setItem("token", r.token);
                        this.$router.push("/");
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
.login {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    &Panel {
        max-width: 450px;
        display: flex;
        flex: 0 1 500px;
        margin: 15px;
        flex-direction: column;
        gap: 10px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.1) 0 0 50px;
        background: white;

        h3 {
            font-weight: 400;
        }

        &Bad {
            position: absolute;
            width: 50px;
            height: 50px;

            top: -5px;
            right: 0;

            transform: scale(0.5);
            opacity: 0.7;

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
            top: -4px;
            right: -4px;

            transform: scale(0.5);
            opacity: 0.7;

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
            color: #580eff;
            font-weight: 800;
        }


        div {
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 5px 10px;
            position: relative;

            p {
                height: 17px;
                font-size: 0.6rem;
                width: 100%;
            }

            input {
                padding: 0;
                border: none;
                border-radius: 0;
                font-weight: 500;
                width: calc(100% - 30px);
                font-size: 1rem;

                &::placeholder {
                    font-weight: 100;
                }
            }
        }
    }
}
</style>


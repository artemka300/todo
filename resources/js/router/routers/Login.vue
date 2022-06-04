<template>
    <div class="login">
        <div class="loginPanel">
            <h3>Вход</h3>
            <div>
                <p>{{ textlogin.text }}</p>
                <span :class="textlogin.class" class="tr-04"></span>
                <input type="text" @input="placeholderLoginRamdom()" v-model="login" :placeholder="placeholderLogin">
            </div>
            <div>
                <p>{{ textlogin.password }}</p>
                <input type="password" v-model="password" @input="placeholderRamdom()" :placeholder="placeholder">
            </div>
            <router-link to="/reg">Зарегистрироваться?</router-link>
        </div>
    </div>
</template>
<script>
export default {
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
            else if (this.password.length < 6) {
                ps = 'Ваш пароль небезопасен'
            }
            else {
                ps = ''
            }
            if (this.login.length > 5) {
                this.loginCheck()
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


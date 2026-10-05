<script setup lang="ts">
import eyeIcon from '@/assets/imgs/icons/fi_eye.svg'
import eyeIconOff from '@/assets/imgs/icons/fi_eye-off.svg'
import { ref } from 'vue';


const isPasswordVisible = ref(false);
const login = ref('');
const password = ref('');


const handleSubmit = () =>{
    console.log("welcome");
    
}

</script>

<template>
<form class="login-form" @submit.prevent="handleSubmit">
                <div class="field-block">
                    <label for="login">Логин</label>
                    <input  class="register-form__login-input input" 
                            type="text" 
                            placeholder="Ведите логин"
                            v-model="login"
                            autofocus>
                   
                </div>
                
                <div class="field-block">
                    <label for="password">Пароль</label>

                    <div class="password-field">
                        <input  class="login-password-input input" 
                            :type="isPasswordVisible ? 'text': 'password' "
                            placeholder="Ведите Пароль"
                            v-model="password"
                            > 

                    <button class="password-field__toggle" type="button" @click="isPasswordVisible = !isPasswordVisible">
                        <img :src="isPasswordVisible ? eyeIconOff : eyeIcon" alt="Показать пароль">
                    </button> 

                    </div>

                   

                     
                </div>
                
                <hr>
                <button class="login-form__btn" type="submit">Войти</button>

                
                
            </form>
            <div class="login-form__footer">
                <p> Есть Аккаунт?</p>
                <router-link class="login-form__footer-link" to="/register" >Войти</router-link>
            </div>

</template>

    
<style scoped>
.login-form{
        margin-top: 39px;
        display: flex;
        flex-direction: column;
        max-width: 360px;
        width: 100%;
        gap: 19px;
        
        
        
    }
    .field-block{
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .login-form label {
        font-family: var(--main-font);
        font-weight: 500;
        font-size: 13px;
        
    }

    .login-form__btn{
        background-color: var(--form-btn);
        border: none;

        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        color: #fff;

        font-family: var(--main-font);
        font-weight: 500;

        

    }

    .password-field{
        position: relative;
        width: 100%;
    }

    .password-field__toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 0;
        border: none;
        background: transparent;
        cursor: pointer;


    }

    .password-field .input { /** что бы текст не заходил на глазик */
        padding-right: 42px;
    }

    .password-field__toggle img{
        width: 20px;
        height: 20px;
    }

    .login-form__footer{
        display: flex;
        gap: 10px;

        margin-top: 20px;
        
    }

    .login-form__footer p{
        font-family: var(--logo-font);
        font-weight: 500;
        font-size: 12px;
    }
    .login-form__footer-link{
        color: blue;
        font-family: var(--main-font);
        font-weight: 600;
        font-size: 12px;
    }
</style>
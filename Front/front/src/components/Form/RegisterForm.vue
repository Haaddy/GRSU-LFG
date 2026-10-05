<script setup lang="ts" >
import eyeIcon from '@/assets/imgs/icons/fi_eye.svg'
import eyeIconOff from '@/assets/imgs/icons/fi_eye-off.svg'

import { ref } from 'vue';


const login = ref('');
const email = ref('');
const password = ref('');
const confirmPassword = ref('');

const errors = ref({
    login: '',
    email: '',
    password: '',
    confirmPassword: ''
})

const isPasswordVisible = ref(false);
const isPasswordConfirmVisible = ref(false);


const handleSubmit = () =>{
    const isValidate = validateForm();
    
    if(isValidate){
        console.log("Send Data and register");
        
    }else{
        console.log("invalid data");
        return
        
    }
}

const validateForm = () => {
    
    errors.value = {
        login: '',
        email: '',
        password: '',
        confirmPassword: ''
    }

    
    if (!login.value.trim()) {
        errors.value.login = 'Введите логин'
    } else if (login.value.trim().length < 3) {
        errors.value.login = 'Логин должен содержать минимум 3 символа'
    }

   
    if (!email.value.trim()) {
        errors.value.email = 'Введите Email'
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        errors.value.email = 'Введите корректный Email'
    }

    
    if (!password.value) {
        errors.value.password = 'Введите пароль'
    } else if (password.value.length < 8) {
        errors.value.password = 'Пароль должен содержать минимум 8 символов'
    }

   
    if (!confirmPassword.value) {
        errors.value.confirmPassword = 'Подтвердите пароль'
    } else if (password.value !== confirmPassword.value) {
        errors.value.confirmPassword = 'Пароли не совпадают'
    }

    
    return Object.values(errors.value).every(error => error === '')
}

</script>

<template>
    <form class="register-form" @submit.prevent="handleSubmit">
                <div class="field-block">
                    <label for="login">Логин</label>
                    <input  class="register-form__login-input input" 
                            type="text" 
                            placeholder="Ведите логин"
                            v-model="login"
                            autofocus>
                    <p v-if="errors.login" class="error">
                        {{ errors.login }}
                    </p>
                </div>
                <div class="field-block">
                    <label for="email">Email</label>
                    <input  class="register-form__email-input input"
                             type="text" 
                             placeholder="Ведите Email"
                             v-model="email">
                    <p v-if="errors.email" class="error">
                         {{ errors.email }}
                     </p>        
                </div>
                <div class="field-block">
                    <label for="password">Пароль</label>

                    <div class="password-field">
                        <input  class="register-confirm-password-input input" 
                            :type="isPasswordConfirmVisible ? 'text': 'password' "
                            placeholder="Ведите Пароль"
                            v-model="password"> 

                    <button class="password-field__toggle" type="button" @click="isPasswordConfirmVisible = !isPasswordConfirmVisible">
                        <img :src="isPasswordConfirmVisible ? eyeIconOff : eyeIcon" alt="Показать пароль">
                    </button> 

                    </div>

                    <p v-if="errors.password" class="error">
                         {{ errors.password }}
                     </p> 

                     
                </div>
                
                <div class="field-block">

                    <label for="password">Потвердить Пароль</label>
                    <div class="password-field">
                        <input  class="register-confirm-password-input input" 
                            :type="isPasswordVisible ? 'text': 'password' "
                            placeholder="Потвердите Пароль"
                            v-model="confirmPassword">
                        <button class="password-field__toggle" type="button" @click="isPasswordVisible = !isPasswordVisible">
                            <img :src="isPasswordVisible ? eyeIconOff : eyeIcon" alt="Показать пароль">
                        </button> 
                    </div>
                    

                    <p v-if="errors.confirmPassword" class="error">
                         {{ errors.confirmPassword }}
                     </p>  
                </div>
                <hr>
                <button class="register-form__btn" type="submit">Зарегистрироватся</button>

                
                
            </form>
            <div class="register-form__footer">
                <p> Есть Аккаунт?</p>
                <router-link class="register-form__footer-link" to="" >Войти</router-link>
            </div>
</template>

<style scoped>
.register-form{
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
    .register-form label {
        font-family: var(--main-font);
        font-weight: 500;
        font-size: 13px;
        
    }

    .register-form__btn{
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

    .register-form__footer{
        display: flex;
        gap: 10px;

        margin-top: 20px;
        
    }

    .register-form__footer p{
        font-family: var(--logo-font);
        font-weight: 500;
        font-size: 12px;
    }
    .register-form__footer-link{
        color: blue;
        font-family: var(--main-font);
        font-weight: 600;
        font-size: 12px;
    }

    </style>
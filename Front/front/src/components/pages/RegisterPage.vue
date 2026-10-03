<script setup lang="ts">

</script>

<template>

    <main class="grid">
        <div class="col1">

        </div>
        <div class="col2">
            <h1>Добро пожаловать</h1>
            <form class="register-form">
                <div class="field-block">
                    <label for="login">Логин</label>
                    <input  class="register-form__login-input input" type="text" placeholder="Ведите логин">
                </div>
                <div class="field-block">
                    <label for="email">Email</label>
                    <input  class="register-form__email-input input" type="text" placeholder="Ведите Email">
                </div>
                <div class="field-block">
                    <label for="password">Пароль</label>
                    <input  class="register-confirm-password-input input" type="password" placeholder="Ведите Пароль">  
                </div>
                
                <div class="field-block">
                    <label for="password">Потвердить Пароль</label>
                    <input  class="register-confirm-password-input input" type="password" placeholder="Потвердите Пароль">
                </div>
                <hr>
                <button class="register-form__btn" type="submit">Зарегистрироватся</button>
            </form>
        </div>
    </main>
</template>

<style>
    hr{
        border: none;
        border-top:1px solid #E5E5E5 ;
        border-radius: 8px;
        width: 360px;
        margin: 30px auto;
    }

    .grid{
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        grid-template-rows: 1fr;
        min-height: 100vh;
    }

    .col1{
        background-image: url("@/assets/imgs/auth-bg.png");
        height: 100%;
        
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        
    }


    .col2{
        padding: 48px 58px;
    }

    .col2 h1{
        font-family: var(--main-font);
        font-weight: 500;
    }
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
        display: inline;
        background-color: var(--form-btn);
        border: none;

        width: auto;
        padding: 10px 104px;
        border-radius: 8px;
        color: #fff;

        font-family: var(--main-font);
        font-weight: 500;

        

    }

     @media (max-width: 960px){
        .grid {
            grid-template-columns: 1fr;
        }

        .col1 {
            display: none; 
        }

        .col2 {
            padding: 40px 20px; 
            align-items: center;
            margin: 0 auto;
        }
     }

    @media (max-width:768px ) {
        .grid {
            grid-template-columns: 1fr; 
        }

        .col1 {
            display: none; 
        }

        .col2 {
            padding: 40px 20px; 
            align-items: center;
            margin: 0 auto;
        }
    }
</style>
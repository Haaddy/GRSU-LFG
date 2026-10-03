<script setup lang="ts"></script>

<template>
    <header class="header">
        <div class="header__container container">
            <h1 class="header__logo">GRSU</h1>
            <nav class="header__navbar">
                <ul class="header__list">
                <li class="header__element">Home</li>
                <li class="header__element" >about</li>
                <li class="header__element">work</li>
                </ul>
            </nav>
            <div class="header__actions">
                <router-link to="/login" href="@" class="header__login">Login</router-link>
                <router-link to ="/register" href="@" class="header__register">Register</router-link>
            </div>
        </div>
      
    </header>
</template>

<style scoped>
    .header{
        
        width: 100%;
        height: 100px;
    }

    .header__container{
        display: flex;
        justify-content: space-between;
        align-items: center;

        height: 96px;
    }

    .header__logo{
        font-family: var(--logo-font);
        font-size: var(--logo-size);
    }
    .header__navbar{
        max-width: 350px;
        width: 100%;
    }
    .header__list{
        display: flex;
        list-style: none;
        justify-content: space-between;
        
    }
    .header__element{
        font-family: var(--main-font);
        font-weight: 500;
    }

    .header__actions{
        display: flex;
        gap: 20px;
    }

    a{
        text-decoration: none;
        color: black;
    }

    .header__login{
        color: #fff;
        background-color: #000;
        padding: 15px 29px;
        border-radius: 18px;

        font-family: var(--main-font);
        font-weight: 500;

    }
    .header__register{
        color: #000;
        border: solid 1px #000;
        padding: 15px 29px;
        border-radius: 18px;

        font-family: var(--main-font);
        font-weight: 500;
    }

    .header__login:hover{
        scale: 1.1;
        transition: 0.3s;
    }

    .header__register:hover{
        scale: 1.1;
        transition: 0.3s;
    }




    

</style>
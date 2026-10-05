<script setup lang="ts">
import RegisterForm from '../Form/RegisterForm.vue';






</script>

<template>

    <main class="grid">
        <div class="col1 zavozik">

        </div>
        <div class="col2">
            <h1>Добро пожаловать</h1>
            <RegisterForm/>
        </div>
    </main>
</template>

<style>
    hr{
        border: none;
        border-top:1px solid #E5E5E5 ;
        border-radius: 8px;
        width: 100%;
        max-width: 360px;
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

    .zavozik{
         background-image: url("@/assets/imgs/ronaldo.png");
    }

    .col2{
        padding: 48px 58px;
        place-items: center;
        
    }

    .col2 h1{
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
            
        }
    }
</style>
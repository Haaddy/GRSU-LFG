<template>
    <main class="hero zavoz">
      <div class="hero__container container">
        <!--блок для завоза  -->
        <div class="hero__title">
            <p>СПАСИБО НАШИМ СПОНСОРАМ</p>
            <h1>Собери друзей что бы депнуть всю степендию</h1>
            <p>Этот сайт не существовал бы без поддержки наших друзей и партнёров. Отдельное спасибо нашим спонсорам из мира онлайн-казино — за то, что верите в проект и помогаете ему расти. Ваш вклад — это стабильная работа сайта, свежий контент и новые возможности для пользователей.</p>
            <a href="" >Депнуть</a>
        </div>
        
        <!-- !нужный блок -->
        <!-- <div class="hero__title">
            <p>ПОИСК КОМАНДЫ</p>
            <h1>Собери Состав на Мероприятие</h1>
            <p>Хакатон, фестиваль, забег или квиз — найдите людей, которым не хватает именно вас, или закройте свободную роль в своей команде</p>
            <a href="" >Get Started</a>
        </div> -->
        
      </div>
    </main>
    
</template>

<style scoped>

    .zavoz{
        background-image: url(@/assets/imgs/zavoz-bg.png);
        background-size: cover;
        background-position: center;
    }
    p, h1 {
        color: #fff;
        font-family: var(--main-font);

        font-weight: 700;
        

    }
   

     .hero{
        background-color: #121B68;
        height: 74vh;

        
     }

     .hero__container{
        border-left: solid 1px #fff;
        border-right: solid 1px #fff;
        height: 100%;

        padding: 150px;

     }
     .hero__title{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-self: center;
        gap: 36px;
        max-width: 929px;
        width: 100%;
     }

     .hero__title p, h1{
        text-align: center;
     }

     .hero__title a{
        background-color: #fff;
        border-radius: 18px;
        color: #121B68;
        padding: 15px 29px;
     }
     .hero__title a:hover{
        scale: 1.1;
        transition: 0.3s;
     }

     .hero__title h1{
        font-size: clamp(1.4rem, 3vw, 2rem);
        line-height: 1.2;
     }

     .hero__title p{
        font-size: clamp(0.875rem, 1.5vw, 1rem);
        line-height: 1.5;
     }

     @media (max-width: 960px){
        .hero{
            height: auto;
            min-height: 70vh;
        }

        .hero__container{
            padding: 72px 40px;
        }

        .hero__title{
            gap: 28px;
        }
     }

     @media (max-width: 768px){
        .hero{
            min-height: 0;
        }

        .hero__container{
            padding: 48px 20px;
        }

        .hero__title{
            gap: 20px;
        }
     }

     @media (max-width: 480px){
        .hero__container{
            padding: 36px 16px;
        }

        .hero__title{
            gap: 16px;
        }

        .hero__title a{
            width: 100%;
            text-align: center;
            padding: 14px 20px;
        }
     }
</style>
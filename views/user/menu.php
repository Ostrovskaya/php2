<?php if (app\models\User::isLogin()): ?> 
    <a href="?c=user"><?=app\models\User::getUserName()?></a>
    <a href="#" class="exit">Выйти</a>
<?php else: ?>    
    <a href="?c=user&a=login">Войти</a>
    <a href="?c=user&a=reg">Регистрация</a>
<?php endif; ?>

<div class="logout">
    <h2>Вы уверены, что хотите выйти?</h2>
    <div class="block">
    <input class="yes" type="button" value="Да">
    <input class="no" type="button" value="Нет">
    </div>
</div> 

<script>
    let exit = document.querySelector('.logout');
    <?php if (app\models\User::isLogin()): ?> 
        let link = document.querySelector('.exit');
        link.addEventListener('click', evt =>{
        evt.preventDefault();
        
        exit.style.display = "block";
    });
    <?php endif; ?>

    let noBtn = document.querySelector('.no');
    let yesBtn = document.querySelector('.yes');

    noBtn.addEventListener('click', evt =>{
        exit.style.display = "none";
    });

    yesBtn.addEventListener('click', evt =>{    
        exit.style.display = "none";
        fetch("/", {
            method: 'POST',
            headers: {
                'Content-Type':  'application/x-www-form-urlencoded'
            },
            body:  'c=user&a=logout'
        })
        .then( (response) => {
            if (response.status !== 200) {           
                return Promise.reject();
            }  
            return response.text();
        })
        .then(response => {
            console.log('OK');  
        })
        .catch(() => console.log('ошибка')); 
    });
    
</script>


<style>
    .logout{
        position: fixed;
        left: calc(50% - 250px);
        top: 200px;
        padding: 20px;
        border: 2px solid #817f7f;
        background-color: floralwhite;
        display: none;
    }

    .block {
        display: flex;
        justify-content: space-evenly;
    }

    .yes,
    .no  {
        width: 70px;
        font-size: 20px;
    }
</style>
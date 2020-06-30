<?php /** @var \app\models\Product $model */?>

<h1><?=$product->name?></h1>
<img width="400"  class="pic" src="https://placehold.it/300x200" alt="<?=$product->name?>">

<div class="price"><?=$product->price?> &#8381;</div>

<br>

<input class="addToCart" data-id="<?=$product->id?>" type="submit" value="Добавить в корзину">
<br>

<br>
<a href="../cart">Перейти в корзину</a>
<br>

<div class="detailedDescription">
    <h3>Описание товара</h3>
    <p><?=$product->description?></p>
</div>


<script>
    let addToCart = document.querySelector('.addToCart');

    addToCart.addEventListener('click', evt =>{
        let id = addToCart.dataset.id;
        
        fetch("../cart/add", {
            method: 'POST',
            headers: {
                'Content-Type':  'application/x-www-form-urlencoded'
            },
            body:  'id=' + id

        })
            .then( (response) => {
                if (response.status !== 200) {           
                    return Promise.reject();
                }  
                return response.json();
            })
        .then(response => {
            alert(response.message);
        })
        .catch(() => console.log('ошибка')); 
    });
    
</script>
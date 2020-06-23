<?php
/** @var array $files */
?>

<h2>Корзина</h2>
<div style="display: flex" class="cart">
<?php foreach ($products as $product): ?>
    <div style="margin-right: 15px;">
        <img  width="200" src="https://placehold.it/300x200" alt="<?=$product['name']?>">
        <h2><?=$product['name']?></h2>
        <p><?=$product['price']?></p>
        <p><?=$product['count']?></p>

        <input class="delete" data-id="<?=$product['id']?>" type="submit" value="Удалить" name="delete">
   
    </div>
<?php endforeach;?>
</div>

<a href="#">Оформить заказ</a>


<script>
    let bts = document.querySelectorAll('.delete');
    
    bts.forEach(el => {
        el.addEventListener('click', evt =>{
            let id = evt.target.dataset.id;
            
            fetch("/", {
                method: 'POST',
                headers: {
                    'Content-Type':  'application/x-www-form-urlencoded'
                },
                body:  'a=delete&' +'c=cart&' + 'id=' + id

            })
                .then( (response) => {
                    if (response.status !== 200) {           
                        return Promise.reject();
                }   
            return response.text()
            })
            .then(i => console.log(i))
            .catch(() => console.log('ошибка')); 
        });
    })
    
</script>
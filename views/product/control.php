<h2>Товары</h2>
<div class="catalog">
<?php foreach ($products as $product): ?>
    <form  action="../product/change?id=<?=$product['id']?>" class="column" method="post">
        <input class = "name" type="text" name="name" placeholder="Название товара" value="<?=$product['name']?>">
        <input class = "price" type="text" name="price" placeholder="Цена" value="<?=$product['price']?>">
        <textarea class = "desc" name="description" cols="30" rows="10" placeholder="Описание"><?=$product['description']?></textarea>
        <select class = "cat" name="category_id" value="<?=$product['category_id']?>">
            <option <?php if($product['category_id']==1) echo "selected"?> value="1">Еда</option>
            <option <?php if($product['category_id']==2) echo "selected"?> value="2">Одежда</option>
            <option <?php if($product['category_id']==3) echo "selected"?> value="3">Техника</option>
        </select>
        <input class="add" type="submit" value="Изменить">
        <input class="delete" data-id="<?=$product['id']?>" type="button" value="Удалить">
    </form>
<?php endforeach;?>
</div>

<h2>Новый продукт</h2>
<form  action="../product/add" class="column" method="post">
    <input class = "name" type="text" name="name" placeholder="Название товара">
    <input class = "price" type="text" name="price" placeholder="Цена">
    <textarea class = "desc" name="description" cols="30" rows="10" placeholder="Описание"></textarea>
    <select class = "cat" name="category_id">
        <option value="1">Еда</option>
        <option value="2">Одежда</option>
        <option value="3">Техника</option>
    </select>

    <input class="add" type="submit" value="Добавить">
</form>

<style>
    .catalog{
        display: flex;
        flex-wrap: wrap;
    }
    .column{
        display: flex;
        flex-wrap: wrap;
        width: 220px;
        margin-right: 20px;
        margin-bottom: 30px;
    }
    .column > * {
        width: 100%;
        margin-bottom: 10px;
    }
</style>

<script>
    let delBts = document.querySelectorAll('.delete');
    delBts.forEach(el => {
        el.addEventListener('click', evt =>{
        let id = el.dataset.id;
        
        fetch("../product/delete", {
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
                return response.text();
            })
        .then(response => {
            console.log('ок')
        })
        .catch(() => console.log('ошибка')); 
    });
    });
    
    
</script>
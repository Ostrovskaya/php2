
<?php if (!empty($order->products)): ?>
<h2>Ваш заказ:</h2>
<div>
<?php foreach ($order->products as $product): ?>
    <div class="product">
        <img   width="100" src="https://placehold.it/300x200" alt="<?=$product['name']?>">
        <h3><?=$product["product"]['name']?></h3>
        <p><?=$product["product"]['price']?> &#8381;</p>
        <p><?=$product['count']?> шт</p>
    </div>
</div>
<?php endforeach;?>
<h2>Итого: </h2>
<p>Общее количество:<?=$order->count?> шт</p>
<p>Общая стоимость: <?=$order->total_price?> &#8381;</p>

<form action="order/add" method="post" style="display:flex; flex-direction:column"> 
 <div>
    <h2>Котактные данные:</h2>
    <label>ФИО получателя
    <input type="text" name="name"></label>
    <br>
    <label>Адрес доставки: 
    <textarea name="address" id="" cols="22" rows="5"></textarea></label>
    <br>
    <label>Контактный номер: 
    <input type="phone" name="phone"></label>
</div>
<div>
    <h2>Выберете способ оплаты:</h2>
    <select name="pay" id="">
        <option value="card1">Картой на сайте</option>
        <option value="card2">Картой при получении</option>
        <option value="cash">Наличными</option>
    </select>
</div>
<input class="send" type="submit" value="Отправить">
</form>
<?php endif; ?>

<?php if (empty($order->products)): ?>
    <h2>Ваша корзина пуста!</h2>
    <a href="../">Каталог</a>
<?php endif; ?>

<style>
.product{
    display: flex;
    justify-content: space-between;
    width: 400px;
}
input,
textarea {
    display: block;
}
.send{
    width: 150px;
    margin-top: 20px;
    margin-bottom: 10px;
}
</style>
<?php
/** @var array $files */
?>


<br>
<a href="cart">Перейти в корзину</a>

<h2>Каталог</h2>
<div style="display: flex" class="catalog">
<?php foreach ($products as $product): ?>
    <figure>
        <a href="product/card?id=<?=$product['id']?>">
            <img  width="200" class="catalogImg" src="https://placehold.it/300x200" alt="<?=$product['name']?>">
        </a>
        <figcaption> 
            <a href="product/card?id=<?=$product['id']?>"><?=$product['name']?></a>
        </figcaption>
    </figure>
<?php endforeach;?>
</div>
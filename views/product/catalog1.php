<br>
<a href="?c=cart">Перейти в корзину</a>

<h2>Каталог</h2>
<div style="display: flex" class="catalog">
{% for product in products %}
    <figure>
            <img  width="200" class="catalogImg" src="https://placehold.it/300x200">
    </figure>
{% endfor %}
</div>
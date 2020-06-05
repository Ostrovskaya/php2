<?php

//Задание 1-4

class ListProducts {
    public $products = [];

    public function addProduct(int $id, string $name, int $price, int $count){
        $this->products[] =
            [
                "id" => $id,
                "name" => $name,
                "price" => $price,
                "count" => $count,
            ];
    }
}

class Order extends ListProducts {
    public $id;
    public $user;
    public $total_price = 0;
    public $total_count = 0;
    public $delivery;


    public function __construct(int $id, string $user, string $delivery)
    {
        $this->id = $id;
        $this->user = $user;
        $this->delivery = $delivery;   
    }

    public function addProduct(int $id, string $name, int $price, int $count){
        parent::addProduct($id, $name, $price, $count);

        $this->setTotalCount($count);
        $this->setTotalPrice($price);
    }
    

    protected function setTotalPrice(int $price){
        $this->total_price += $price;
    }

    protected function setTotalCount($count){
        $this->total_count += $count;
    }
}

$order = new Order(1, "Вася",  "самовывоз");
$order->addProduct(1, "мышка", 1000, 1);
$order->addProduct(2, "клавиатура", 2000, 2);

echo "Id заказа: " . $order->id . "<br>";
echo "Сумма заказа: " . $order->total_price . "<br>";
echo "Количество продуктов в заказе: " . $order->total_count . "<br>";
echo "Способ доставки: " . $order->delivery . "<br>";

echo  "<br><br>";
//Задание 5 

class A {
    public function foo() {
        static $x = 0;   //Статическая переменная внутри функции. 
        //будет сохранять результат всех предыдущих вызовов функции из этого класса
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();  //1  
$a2->foo();  //2
$a1->foo();  //3
$a2->foo();  //4

echo  "<br><br>";
//Задание 6 

class B {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class C extends B {
  //теперь у нас 2 разных класса и разных функции. 
  //Статическая переменная будет содержать в себе сохраненное значение в классе наследнике отдельно
}
$b1 = new B();   
$c1 = new C();
$b1->foo();  //1
$c1->foo();  //1
$b1->foo();  //2
$c1->foo();  //2

echo  "<br><br>";
//Задание 7 
//Ну у нас конструктор не прописан, поэтому ничего не должно было поменятся
class D {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class E extends D {
}
$d1 = new D;
$e1 = new E;
$d1->foo();  //1 
$e1->foo();  //1
$d1->foo();  //2 
$e1->foo();  //2 
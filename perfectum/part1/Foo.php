<?php

class Foo
{
	private $bar1;
	private $bar2;
	private $bar3;
	private $i;

//Создаем экземпляр класса
//Инициализируем массив для слияния и свойство для хранения заданного кол-ва элементов
//По умолчанию число элементов каждого массива равно 20
	public function __construct(int $i = 20) 
	{
		$this->i = $i;
		$this->bar3 = []; 
		$char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		for ($r = 0; $r < $i; $r++) {
			$this->bar1[] = rand(1, $i);
			$this->bar2[] = $char[rand(0, $i)];
		}
	}

//Метод для слияния двух массивов в один, значения чередуются
	public function merge_bar()
	{
		for ($a = 0; $a < $this->i; $a++) {
			array_push($this->bar3, $this->bar1[$a], $this->bar2[$a]); 
		}
		return $this->bar3;
	}

//Метод для вывода всех массивов
	public function print_bar()
	{
		echo "Массив #1: <br><pre>";
		print_r($this->bar1);
		echo "</pre><br>";
		echo "Массив #2: <br><pre>";
		print_r($this->bar2);
		echo "</pre><br>";
		echo "Массив #3: <br><pre>";
		print_r($this->merge_bar());
		echo "</pre><br>";	
	}

}

//Создаем экземпляр класса
// В скобках одним параметром (целое число) можно указать желаемое кол-во элементов массивов 1 и 2
$foo = new Foo(); 

//Вызываем метод для вывода всех массивов 
$foo->print_bar();

?>


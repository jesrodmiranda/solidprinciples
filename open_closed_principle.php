<?php

/*
 * Si quisiéramos que el métdo sum pudiera calcular la suma de más figuras, tendríamos que seguir añadiendo bloques if/else, 
 * lo que va en contra del principio Open/Closed.
 * Una forma de hacer este método sum mejor es moviendo la lógica de calcular el area a la clase de cada figura, 
 * añadiendo un método area() en cada clase:
 */

Class Circle {

    public $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function area() {
        return pi() * pow($this->radius, 2);
    }

}

Class Square {

    public $length;

    public function __construct($length) {
        $this->length = $length;
    }

    public function area() {
        return pow($this->length, 2);
    }

}

class AreaCalculator {

    protected $shapes;

    public function __construct($shapes = array()) {
        $this->shapes = $shapes;
    }

    public function sum() {
        foreach ($this->shapes as $shape) {
            $area[] = $shape->area();
        }

        return array_sum($area);
    }

    public function output() {
        return implode('', array(
            "<h1>",
            "Suma de todas las áreas: ",
            $this->sum(),
            "</h1>"
        ));
    }

}

class SumCalculatorOutputter {

    protected $calculator;

    public function __construct(AreaCalculator $calculator) {
        $this->calculator = $calculator;
    }

    public function toJson() {
        $data = array(
            'sum' => $this->calculator->sum()
        );

        return json_encode($data);
    }

    public function toHtml() {
        return implode('', array(
            '<h1>',
            'Suma de las áreas de las figuras: ',
            $this->calculator->sum(),
            '</h1>'
        ));
    }

}

$shapes = array(
    new Circle(3),
    new Square(4)
);

$areas = new AreaCalculator($shapes);

echo $areas->output();


$output = new SumCalculatorOutputter($areas);

echo $output->toJson();
echo $output->toHtml();

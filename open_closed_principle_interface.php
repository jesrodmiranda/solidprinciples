<?php

/*
 * Ahora podemos crear cualquier otra figura y pasarla para calcular la suma que no se romperá el código. 
 * Ahora la pregunta es la siguiente: ¿Cómo sabemos que el objeto que se pasa a AreaCalculator es realmente 
 * una figura o si la figura tiene un método llamado área?
 * 
 * Crear interfaces es una parte integral de los principios SOLID. Vamos a crear una interface que ha de implementar cada figura:
 */

interface ShapeInterface {

    public function area();
}

Class Circle implements ShapeInterface {

    public $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function area() {
        return pi() * pow($this->radius, 2);
    }

}

Class Square implements ShapeInterface {

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
            /*
             * En el método sum de AreaCalculator podemos comprobar si las figuras proporcionadas 
             * son realmente instancias de ShapeInterface, y sino, lanzar una excepción:
             */
            if ($shape instanceof ShapeInterface) {
                $area[] = $shape->area();
            } else {
                throw new AreaCalculatorInvalidShapeException;
            }
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

<?php

/*
 * Una clase sólo debe tener un motivo para cambiar, lo que significa que sólo debe tener una tarea.
 * 
 * Tenemos varias figuras de las que después queremos calcular su área total:
 */


/*
 * Primero creamos las clases de las figuras y dejamos que los constructores se encarguen de recibir las medidas necesarias.
 */

Class Circle {

    public $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

}

Class Square {

    public $length;

    public function __construct($length) {
        $this->length = $length;
    }

}

/*
 * Ahora creamos la clase AreaCalculator, que recibe un array con los objetos de cada una de las figuras para ser sumadas:
 */

class AreaCalculator {

    protected $shapes;

    public function __construct($shapes = array()) {
        $this->shapes = $shapes;
    }

    public function sum() {
        foreach ($this->shapes as $shape) {
            if (is_a($shape, 'Square')) {
                $area[] = pow($shape->length, 2);
            } elseif (is_a($shape, 'Circle')) {
                $area[] = pi() * pow($shape->radius, 2);
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

/*
 * Para utilizar la clase AreaCalculator simplemente instanciamos la clase y le pasamos un array con las figuras, mostrando el output al final:
 */
$shapes = array(
    new Circle(3),
    new Square(4)
);

$areas = new AreaCalculator($shapes);

echo $areas->output();


/*
 * El problema del método output es que la clase AreaCalculator además de calcular las áreas maneja la lógica de la salida de los datos. 
 * El problema surge cuando queremos mostrar los datos en otros formatos como json, por ejemplo.
 * 
 * El principio Single responsibility determinaría en este caso que AreaCalculator sólo calculase el área, y que la funcionalidad de la 
 * salida de los datos de produjera en otra entidad. Para ello podemos crear la clase SumCalculatorOutputter, que determinará como mostraremos 
 * los datos de las figuras. Con esta clase el código quedaría así:
 */

Class SumCalculatorOutputter {

    public $areas;

    public function __construct($areas) {
        $this->areas = $areas;
    }

    public function toJson() {

        echo "JSON: " . json_encode($this->areas);
    }

    public function toHtml() {

        echo "<h1>HTML:</h1> <p>" . print_r($this->areas) . "</p>";
    }

}

$output = new SumCalculatorOutputter($areas);

echo $output->toJson();
echo $output->toHtml();

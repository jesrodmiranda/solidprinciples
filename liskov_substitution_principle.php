<?php

/*
 * Una clase nunca debe ser forzada a implementar una interface que no usa, empleando métodos que no tiene por qué usar.
 * De nuevo en el ejemplo de figuras, sabemos que también tenemos figuras con volumen, por lo que podríamos añadir el 
 * método volume en la interface ShapeInterface:
 */

interface ShapeInterface 
{
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
            "Suma de todas las figuras: ",
            $this->sum(),
            "</h1>"
        ));
    }

}

class VolumeCalculator extends AreaCalculator {

    public function __construct($shapes = array()) {
        parent::__construct($shapes);
    }

    public function sum() {
        foreach ($this->shapes as $shape) {
            if (is_a($shape, 'Square')) {
                $area[] = pow($shape->length, 2)*$shape->length;
            } elseif (is_a($shape, 'Circle')) {
                $area[] = pi()*pow($shape->radius, 2)*$shape->radius; // M_PI = 3.1415926535898;
            }
        }
        return array_sum($area);
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

echo $areas->output() . "<br>";

$volumes = new VolumeCalculator($shapes);

echo $volumes->output() . "<br>";

$output = new SumCalculatorOutputter($areas);

echo $output->toJson();
echo $output->toHtml();

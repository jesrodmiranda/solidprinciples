<?php

/*
 * Interface segregation principle
 * Una clase nunca debe ser forzada a implementar una interface que no usa, empleando métodos que no tiene por qué usar.
 * De nuevo en el ejemplo de figuras, sabemos que también tenemos figuras con volumen, por lo que podríamos añadir 
 * el método volume en la interface ShapeInterface:
 * 
 * 
 * 

interface ShapeInterface {
    public function area();
    public function volume();
}
 * 
 */

interface ShapeInterface {
    public function area();
}


interface SolidShapeInterface
{
    public function volume();
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

Class Cube implements ShapeInterface, SolidShapeInterface {

    public $length;

    public function __construct($length) {
        $this->length = $length;
    }

    public function area() {
        return pow($this->length, 2);
    }
    
    public function volume() {
        return pow($this->length, 2)*$this->length;
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
           
            if ($shape instanceof ShapeInterface) {
                $volume[] = $shape->volume();
            } else {
                throw new VolumeCalculatorInvalidShapeException;
            }
        }
        
        return array_sum($volume);
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

$volumeshapes = array(
    new Cube(3)
);


$areas = new AreaCalculator($shapes);

echo $areas->output() . "<br>";

$volumes = new VolumeCalculator($volumeshapes);

echo $volumes->output() . "<br>";

$output = new SumCalculatorOutputter($areas);

echo $output->toJson();
echo $output->toHtml();

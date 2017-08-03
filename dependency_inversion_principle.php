<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * 
 * 
 * 
 * 
 Dependency inversion principle

Las entidades deben depender de abstracciones no de concreciones. El módulo de alto nivel no debe depender del módulo de bajo nivel, pero deben depender de abstracciones.

Cambiamos ahora el ejemplo por uno relacionado con bases de datos:

class PasswordReminder
{
    private $dbConnection;

    public function __construct(MySQLConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }
}
MySQLConnection es el módulo de bajo nivel, mientras que PasswordReminder es de alto nivel. Este ejemplo no respeta el principio SOLID de dependency inversion ya que se está forzando a la clase PasswordReminder a depender en la clase MySQLConnection.

Si después quieres cambiar el motor de base de datos tendrás que cambiar la clase PasswordReminder también, lo que viola el principio open-closed.

A la clase PasswordReminder no debería importarle que base de datos emplea tu aplicación, y para solucionarlo empleamos una interface:

interface DBConnectionInterface
{
    public function connect();
}
La interface tiene un método connect y la clase MySQLConnection implementa esta interface. En lugar de hacer type hinting con la clase MySQLConnection en PasswordReminder, lo hacemos con la interface, de forma que no importa el tipo de base de datos que empleemos, que PasswordReminder conectará a la base de datos sin problemas:

class MySQLConnection implements DBConnectionInterface {
    public function connect() {
        return "Conexión a la base de datos";
    }
}

class PasswordReminder {
    private $dbConnection;

    public function __construct(DBConnectionInterface $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}
Ahora podemos ver que tanto los niveles altos como los bajos dependen de abstracciones.


 */
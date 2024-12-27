<?php

class Client {
    public string $name;
    public string $lastName;
    public string $dni;

    public function __construct(string $name, string $lastName, string $dni) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->dni = $dni;
    }
}

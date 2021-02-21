<?php

    namespace App;

    class App
    {
        private array $dogs = [
            'Dachshund',
            'Plush Labrador',
            'Pug',
            'Rubber Dachshund',
            'Shiba Inu'
        ];

        private array $commands = [
            'breed'   => 'getBreed',
            'hunting' => 'letsGoHunt',
            'sound'   => 'makeSound'
        ];

        private array $params = [];

        public function __construct (array $params)
        {
            $this->params = $params;
        }

        public function checkCountCommands() : array|bool
        {
            return (in_array(count($this->params), [3, 4]))
                ? $this->params
                : false;
        }

        public function getCommand() : string|bool
        {
            $command = strtolower(end($this->params));

            return (array_key_exists($command, $this->commands))
                    ? $this->commands[$command]
                    : false;
        }

        function getDog() : string|bool
        {
            $dog  = (count($this->params) === 3) ? $this->params[1] : $this->params[1] . ' ' . $this->params[2];
            $dog  = ucwords(strtolower($dog));

            return (in_array($dog, $this->dogs))
                ? str_replace(' ', '', $dog)
                : false;
        }

        public function getResult() : string
        {
            $result = 'WRONG! Try again...';

            if ($this->checkCountCommands() !== false) {

                $command = $this->getCommand();
                $dog     = $this->getDog();

                if (gettype($dog) === 'string' && gettype($command) === 'string') {

                    $dog = "App\Dogs\\" . $dog;

                    $result = (new $dog)->$command();

                }

            }

            return $result;
        }
    }


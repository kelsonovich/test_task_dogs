<?php

    namespace App;

    abstract class Dog
    {
        public function makeSound() : string
        {
            return $this->sound;
        }

        public function letsGoHunt() : string
        {
            return $this->hunt;
        }

        public function getBreed()  : string
        {
            return $this->breed;
        }
    }
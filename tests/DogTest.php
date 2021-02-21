<?php

    use PHPUnit\Framework\TestCase;
    use App\App;

    class DogTest extends TestCase
    {
        public function testCheckCountCommands()
        {
            $this->assertSame(
                    ['index', 'pug', 'sound'],
                    (new App(['index', 'pug', 'sound'])
                )->checkCountCommands());

            $this->assertSame(
                    ['index', 'plush', 'labrador', 'sound'],
                    (new App(['index', 'plush', 'labrador', 'sound'])
                )->checkCountCommands());

            $this->assertFalse((new App(['index']))->checkCountCommands());
            $this->assertFalse((new App(['index', 'pug', 'sound', 'f', 'f']))->checkCountCommands());
        }

        public function testGetCommand()
        {
            $this->assertSame('makeSound', (new App(['index', 'pug', 'sound']))->getCommand());
            $this->assertSame('letsGoHunt', (new App(['index', 'pug', 'hunting']))->getCommand());
            $this->assertSame(
                'getBreed', (new App(['index', 'pug', 'breed'])
                )->getCommand());

            $this->assertFalse((new App(['index', 'pug', 'smile']))->getCommand());
        }

        public function testGetDog()
        {
            $this->assertSame('Dachshund', (new App(['index', 'dachshund', 'sound']))->getDog());
            $this->assertSame('PlushLabrador', (new App(['index', 'pLush', 'labrador', 'sound']))->getDog());
            $this->assertSame('Pug', (new App(['index', 'PUG', 'sound']))->getDog());
            $this->assertSame('RubberDachshund', (new App(['index', 'RUBBER', 'dachshund', 'sound']))->getDog());
            $this->assertSame('ShibaInu', (new App(['index', 'shiba', 'inu', 'sound']))->getDog());

            $this->assertFalse((new App(['index', 'doge', 'sound']))->getDog());
        }

        public function testGetResult()
        {
            $this->assertSame("Pug says 'woof woof!", (new App(['index', 'pug', 'sound']))->getResult());
            $this->assertSame('Dachshunds barking!', (new App(['index', 'dachshund', 'sound']))->getResult());
            $this->assertSame('Shiba inu barking!', (new App(['index', 'shiba', 'inu', 'sound']))->getResult());

            $this->assertSame(
                'Squeak squeak',
                (new App(['index', 'rubber dachshund', 'sound'])
                )->getResult());

            $this->assertSame(
                "Plush Labrador don't make any sounds",
                (new App(['index', 'plush', 'labrador', 'sound'])
                )->getResult());
        }

        public function testWrongInput()
        {
            $this->assertSame('WRONG! Try again...', (new App(['index']))->getResult());
            $this->assertSame('WRONG! Try again...', (new App(['index', 'pugs', 'sound']))->getResult());
            $this->assertSame('WRONG! Try again...', (new App(['index', 'pug', 'sounds']))->getResult());
            $this->assertSame('WRONG! Try again...', (new App(['index', 'test', 'test']))->getResult());
            $this->assertSame('WRONG! Try again...', (new App(['index', 'pug', 'sound', 'f', 'f']))
                ->getResult());
        }
    }
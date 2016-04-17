<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // 1. Visit the home page
        $this->visit('/')
             ->see('Click Me');

        // 2. Press a "Click Me" link
        // 3. Sen "You've been clicked, punk."
        $this->click('Click Me')
             ->see("You've been clicked, punk.");

        // 4. Assert than the current url is /feedback
        $this->seePageIs('/feedback');
    }
}

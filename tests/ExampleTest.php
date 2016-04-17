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
             ->see('Click Me')
             ->click('Click Me')
             ->see("You've been clicked, punk.")
             ->seePageIs('/feedback');
    }
}

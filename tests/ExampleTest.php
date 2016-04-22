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

        //  1. Visit the home page.
        //  2. Press a  "Click Me" Link.
        //  3. See "You've been clicked, punk."
        //  4. Assert that the current url is /feedback.
//        $this->visit('/')
//            ->click('Click Me')
//            ->see("You've been clicked, punk.")
//            ->seePageIs('/feedback');
        $this->visit('/')
            ->see('Laravel 5')
            ->seeEmailWasSent();
    }

   
}

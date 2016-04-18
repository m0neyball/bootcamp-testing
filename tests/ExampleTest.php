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
    public function testBasicExample ()
    {
        // 1. Visit the home page
        // 2. Press a "Click Me" link
        // 3. See "You're been clicked, punk."
        // 4. Assert that the current url /feedback
        /*
        $this->visit('/');
        $this->click('Click Me');
        $this->see("You're been clicked, punk.");
        $this->seePageIs('/feedback');
        */
        $this
            ->visit ('/')
            ->click ('Click Me')
            ->see ("You're been clicked, punk.")
            ->seePageIs ('/feedback');
    }
}

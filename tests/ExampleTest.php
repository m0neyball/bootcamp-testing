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
        Mail::raw('Hello world', function ($message){
            $message->to('foo@bar.com');
            $message->from('foo@bar.com');
        });

        $this->seeEmailWasSent();
    }

    protected function seeEmailWasSent()
    {

    }
}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use MailTracking;

   
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        Mail::raw('Hello world', function ($message){
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
        });

//        $this->seeEmailWasSent();
        $this->seeEmailTo('foo@bar.com');
        $this->seeEmailFrom('bar@foo.com');
    }

    
}



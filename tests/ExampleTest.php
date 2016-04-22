<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener);
    }
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

//        $this->seeEmailWasSent();
    }

    protected function seeEmailWasSent()
    {

    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{
    public function beforeSendPerformed($event)
    {
        $message = $event->getMessage();
//        dd($message->getTo());
//        dd($message->getFrom());
        dd($message->getBody());
    }
}

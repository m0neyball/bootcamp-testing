<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    protected $emails = [];

    public function setUp()
    {
        parent::setUp();

        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener($this));
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
        $this->seeEmailsSent(2);
    }

    public function addEmail(Swift_Message $email)
    {
        $this->emails[] = $email;
    }

    protected function seeEmailWasSent()
    {
        $this->assertNotEmpty($this->emails, 'No emails have been sent.');
    }

    protected function seeEmailsSent($count)
    {
        $emailsSent = count($this->emails);

        $this->assertCount($count, $this->emails,
            "Expected $count emails to have been Sent, but $emailsSent were."
            );
    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{
    protected $test;

    public function __construct($test)
    {
        $this->test = $test;
    }
    
    public function beforeSendPerformed($event)
    {
        $this->test->addEmail($event->getMessage());
    }
}

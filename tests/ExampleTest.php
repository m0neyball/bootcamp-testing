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
    public function testBasicEmailExample ()
    {
        $this
            ->seeEmailWasNotSent ()
            ->visit ('/')
            ->seeEmailWasSent ()
            ->seeEmailsSent (2)
            ->seeEmailTo ('foo@bar.com')
            ->seeEmailFrom ('bar@foo.com')
            ->seeEmailEquals ('Hello World')
            ->seeEmailContains ('Hello');
    }
}


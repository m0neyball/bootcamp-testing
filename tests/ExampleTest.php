<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    protected $emails = [];

    public function setUp ()
    {
        parent::setUp ();
        Mail::getSwiftMailer ()
            ->registerPlugin (new TestingMailEventListener($this));
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicEmailExample ()
    {
        Mail::raw ('Hello World', function ($message) {
            $message->to ('foo@bar.com');
            $message->from ('bar@foo.com');
        });
        $this->seeEmailWasSent ();
    }

    protected function seeEmailWasSent ()
    {
        $this->assertNotEmpty (
            $this->emails,
            'No emails have been sent.'
        );
    }

    public function addEmail (Swift_Message $email)
    {
        $this->emails[] = $email;
    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{

    /**
     * @var
     */
    private $test;

    public function __construct ($test)
    {
        $this->test = $test;
    }

    public function beforeSendPerformed ($event)
    {
        $message = $event->getMessage ();
        $this->test->addEmail ($message);
    }
}

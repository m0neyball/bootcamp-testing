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
        $this->seeEmailsSent(2);
    }

    protected function seeEmailWasSent ()
    {
        $this->assertNotEmpty (
            $this->emails,
            'No emails have been sent.'
        );
    }

    public function seeEmailsSent ($count)
    {
        $emailSent = count($this->emails);
        $this->assertCount(
            $count,
            $this->emails,
            "Expected $count emails to have been sent, but $emailSent were."
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

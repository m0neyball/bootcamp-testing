<?php

trait MailTracking
{
    protected $emails = [];

    /**
     * @before
     */
    public function setUpMailTracking ()
    {
        parent::setUp ();
        Mail::getSwiftMailer ()
            ->registerPlugin (new TestingMailEventListener($this));
    }

    protected function seeEmailWasSent ()
    {
        $this->assertNotEmpty (
            $this->emails,
            'No emails have been sent.'
        );

        return $this;
    }

    public function seeEmailsSent ($count)
    {
        $emailSent = count ($this->emails);
        $this->assertCount (
            $count,
            $this->emails,
            "Expected $count emails to have been sent, but $emailSent were."
        );

        return $this;
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
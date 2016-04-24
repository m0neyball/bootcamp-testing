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

    protected function seeEmailWasNotSent ()
    {
        $this->assertEmpty (
            $this->emails,
            'Did not expect any emails to have been sent.'
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

    public function seeEmailTo ($to, Swift_Message $message = null)
    {
        $this->assertArrayHasKey (
            $to, $this->getEmail($message)->getTo (),
            "No email was sent to $to."
        );

        return $this;
    }

    public function seeEmailFrom ($from, Swift_Message $message = null)
    {
        $this->assertArrayHasKey (
            $from, $this->getEmail($message)->getFrom (),
            "No email was sent from $from."
        );

        return $this;
    }

    public function addEmail (Swift_Message $email)
    {
        $this->emails[] = $email;
    }

    protected function getEmail (Swift_Message $message = null)
    {
        $this->seeEmailWasSent();
        return $message ? : $this->lastEmail();
    }

    protected function lastEmail ()
    {
        return end($this->emails);
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
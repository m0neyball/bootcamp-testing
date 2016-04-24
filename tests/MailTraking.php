<?php

trait MailTracking
{
    protected $emails = [];

    /**
     * @before
     */
    public function setUpMailTracking()
    {
        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener($this));
    }

    protected function seeEmailsSent($count)
    {
        $emailSent = count($this->emails);

        $this->assertCount(
            $count, $this->emails,
            "Expected $count emails to have sent. but $emailSent were."
        );

        return $this;
    }

    protected function seeEmailWasSent()
    {
        $this->assertNotEmpty(
            $this->emails, 'No emails have been sent.'
        );

        return $this;
    }

    protected function seeEmailWasNotSent()
    {
        $this->assertEmpty(
            $this->emails, 'Dit not expect emails to have been sent.'
        );

        return $this;
    }

    protected function seeEmailEquals($body, Swift_Message $message = null)
    {
        $this->assertEquals(
            $body, $this->getEmail($message)->getBody(),
            "No email with the provided body was sent."
        );

        return $this;
    }

    protected function seeEmailContains($excerpt, Swift_Message $message = null)
    {
        $this->assertContains(
            $excerpt, $this->getEmail($message)->getBody(),
            "No email containing the provided body was found."
        );

        return $this;
    }

    /**
     * @param Swift_Message $email
     */
    public function addEmail(Swift_Message $email)
    {
        $this->emails[] = $email;
    }

    public function seeEmailTo($recipient, Swift_Message $message = null)
    {

        $this->assertArrayHasKey($recipient, $this->getEmail($message)->getTo(),
            "No email was sent to $recipient."
        );

        return $this;
    }

    public function seeEmailFrom($sender, Swift_Message $message = null)
    {

        $this->assertArrayHasKey($sender, $this->getEmail($message)->getFrom(),
            "No email was sent from $sender."
        );

        return $this;
    }

    protected function getEmail(Swift_Message $message = null)
    {
        $this->seeEmailWasSent();

        return $message ?: $this->lastEmail();
    }

    protected function lastEmail()
    {
        return end($this->emails);
    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{
    protected $test;

    public function __construct(ExampleTest $test)
    {
        $this->test = $test;
    }

    public function beforeSendPerformed($event)
    {
        $this->test->addEmail($event->getMessage());
    }
}
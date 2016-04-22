<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/22
 * Time: 下午3:43
 */

trait MailTracking
{
    protected $emails = [];

    /**
     * @before
     */
    public function setUpMailTracking()
    {
        parent::setUp();

        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener($this));
    }

    public function addEmail(Swift_Message $email)
    {
        $this->emails[] = $email;
    }
    
    protected function seeEmailWasSent()
    {
        $this->assertNotEmpty($this->emails,
            'No emails have been sent.');
        return $this;
    }
    
    protected function seeEmailsSent($count)
    {
        $emailsSent = count($this->emails);

        $this->assertCount($count, $this->emails,
            "Expected $count emails to have been Sent, but $emailsSent were."
        );

        return $this;
    }

    protected function seeEmailTo($recipient)
    {
        $email = end($this->emails);

        
        $this->assertArrayHasKey($recipient, $email->getTo());

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
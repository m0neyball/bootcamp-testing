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

    /**
     * @test
     */
    public function it_normalizes_a_string_for_the_cache_key ()
    {
        // =================================================================== 1
        /*
        $directive = $this->prophesize (BladeDirective::class);
        $directive
            ->foo ('bar')
            ->shouldBeCalled ()
            ->willReturn ('foobar');
        $response = $directive->reveal ()->foo ('bar');
        $this->assertEquals ('foobar', $response);
         */
        // dd($directive);
        // die(var_dump($directive));
        // =================================================================== 2
        /*
        $cache = new RussianCache;
        $directive = new BladeDirective($cache);

        $directive->setUp('cache-key');
        $directive->setUp($collection);
        $directive->setUp($model);
        */
        $cache = $this->prophesize (RussianCache::class);
        $directive = new BladeDirective($cache->reveal ());
        $cache
            ->has ('cache-key')
            ->shouldBeCalled ();
        $directive->setUp ('cache-key');
    }

    /**
     * @test
     */
    public function it_normalizes_a_cacheable_model_for_the_cache_key ()
    {
        $cache = $this->prophesize (RussianCache::class);
        $directive = new BladeDirective($cache->reveal ());
        $cache
            ->has ('stub-cache-key')
            ->shouldBeCalled ();
        $directive->setUp (new ModelStub);
    }
}

class ModelStub
{
    public function getCacheKey ()
    {
        return 'stub-cache-key';
    }
}

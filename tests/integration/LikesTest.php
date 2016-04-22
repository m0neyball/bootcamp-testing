<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Post;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    protected $post;

    public function setUp ()
    {
        parent::setUp ();
        // given I have a post
        $this->post = factory (Post::class)->create ();
    }

    /**
     * @test
     */
    public function a_user_can_like_a_post ()
    {
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        // when they like a post
        $this->post->like ();
        // then we should see evidence in the database, and the post should be liked.
        $this->seeInDatabase ('likes', [
            'user_id'     => $user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class ($this->post),
        ]);
        $this->assertTrue ($this->post->isLiked ());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_post ()
    {
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        // when they like a post
        $this->post->like ();
        // when they unlike a post
        $this->post->unlike ();
        // then we should see evidence in the database, and the post should be liked.
        $this->notSeeInDatabase ('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class ($this->post),
        ]);
        $this->assertFalse ($this->post->isLiked ());
    }

    /**
     * @test
     */
    public function a_user_may_toggle_a_post_like_status ()
    {
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        $this->post->toggle ();
        $this->assertTrue ($this->post->isLiked ());
        $this->post->toggle ();
        $this->assertFalse ($this->post->isLiked ());
    }

    /**
     * @test
     */
    public function a_post_knows_how_many_likes_it_has ()
    {
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        $this->post->toggle ();
        $this->assertEquals (1, $this->post->likesCount);
    }
}
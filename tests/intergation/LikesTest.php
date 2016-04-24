<?php
use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    protected $post;
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->post = createPost();
        $this->singIn();
    }
    /**
     * @test a user can like post
     */
    public function a_user_can_like_post()
    {
        $this->post->like();

        // the we should see evidence in the database, and the post should be liked.
        $this->seeInDatabase('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertTrue($this->post->isLiked());
    }

    /**
     * @test a user can unlike a post
     */
    public function a_user_can_unlike_a_post()
    {
        $this->post->like();
        $this->post->unlike();

        // the we should see evidence in the database, and the post should be liked.
        $this->notSeeInDatabase('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertFalse($this->post->isLiked());
    }

    /**
     * @test a user may toggle a posts like status
     */
    public function a_user_may_toggle_a_posts_like_status()
    {
        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());

    }

    /**
     * @test a post knows how many likes it has
     */
    public function a_post_knows_how_many_likes_it_has()
    {
        $this->post->toggle();

        $this->assertEquals(1, $this->post->likesCount);
    }

}
<?php
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/21
 * Time: 下午2:36
 */

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    protected $post;

    public function setUp()
    {
        parent::setUp();

        $this->post = factory(Post::class)->create();
        $this->signIn();

    }


    /**
     * @test
     */
    public function a_user_can_like_a_post()
    {
        //given I have a post

        //and a user
        //and that user is logged in

        //when they like a post

        //then we should see evidence in database, and the post should be liked.



        $this->post->like();

        $this->seeInDatabase('likes',[
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertTrue($this->post->isLiked());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_post()
    {



        $this->post->like();
        $this->post->unlike();

        $this->notSeeInDatabase('likes',[
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertFalse($this->post->isLiked());
    }

    /**
     * @test
     */
    public function a_user_may_toggle_a_posts_like_status()
    {


        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());
    }

    /**
     * @test
     */
    public function a_post_knows_how_many_likes_it_has()
    {


        $this->post->toggle();

        $this->assertEquals(1, $this->post->likesCount);
    }
}
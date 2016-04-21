<?php
use App\Post;
use App\User;

/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/21
 * Time: 下午2:36
 */

class LikesTest extends TestCase
{
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
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();

        $this->seeInDatabase('likes',[
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_post()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();
        $post->unlike();

        $this->notSeeInDatabase('likes',[
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isLiked());
    }

    /**
     * @test
     */
    public function a_user_may_toggle_a_posts_like_status()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertTrue($post->isLiked());

        $post->toggle();

        $this->assertFalse($post->isLiked());
    }

    /**
     * @test
     */
    public function a_post_knows_how_many_likes_it_has()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1, $post->likesCount);
    }
}
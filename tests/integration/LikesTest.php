<?php
use App\User;
use App\Post;

class LikesTest extends TestCase
{
    /**
     * @test
     */
    public function a_user_can_like_a_post ()
    {
        // given I have a post
        $post = factory (Post::class)->create ();
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        // when they like a post
        $post->like ();
        // then we should see evidence in the database, and the post should be liked.
        $this->seeInDatabase ('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class ($post),
        ]);
        $this->assertTrue ($post->isLiked ());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_post ()
    {
        // given I have a post
        $post = factory (Post::class)->create ();
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        // when they like a post
        $post->like ();
        // when they unlike a post
        $post->unlike ();
        // then we should see evidence in the database, and the post should be liked.
        $this->notSeeInDatabase ('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class ($post),
        ]);
        $this->assertFalse ($post->isLiked ());
    }

    /**
     * @test
     */
    public function a_user_may_toggle_a_post_like_status ()
    {
        // given I have a post
        $post = factory (Post::class)->create ();
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        $post->toggle ();
        $this->assertTrue ($post->isLiked ());
        $post->toggle ();
        $this->assertFalse ($post->isLiked ());
    }

    /**
     * @test
     */
    public function a_post_knows_how_many_likes_it_has ()
    {
        // given I have a post
        $post = factory (Post::class)->create ();
        // and a user
        $user = factory (User::class)->create ();
        // and that user is logged in
        $this->actingAs ($user);
        $post->toggle ();
        $this->assertEquals (1, $post->likesCount);
    }
}
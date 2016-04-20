<?php
use App\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/20
 * Time: 下午3:20
 */
class ArticleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_fetches_trending_articles()
    {
        //Given
        factory(Article::class, 2)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);
        //When
        $articles = Article::trending();
        //Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
    }
}
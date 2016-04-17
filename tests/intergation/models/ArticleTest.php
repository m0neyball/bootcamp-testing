<?php

use App\Article;

class ArticleTest extends TestCase
{
    /**
     * @test it fetches trending articles
     */
    public function it_fetches_trending_articles ()
    {
        // Given
        factory(Article::class, 2)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        // When
        $articles = Article::trending();

        // Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
    }
}
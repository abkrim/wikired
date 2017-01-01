<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     */
    function a_slug_is_generated_and_saved_to_the_database()
    {
        $user = $this->defaultUser();

        $post = factory(Post::class)->make([
            'title' => 'Como instalar Laravel',
        ]);

        $user->posts()->save($post);

        /*
         * Las dos formas son validas pero cargamos la tercera que garantiza mejor resultado
        $this->seeInDatabase('posts', [
            'slug' => 'como-instalar-laravel',
        ]);

        $this->assertSame('como-instalar-laravel', $post->slug);
        */
        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug);
    }
}

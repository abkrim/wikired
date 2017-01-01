<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase
{
    /**
     * @test
     */
    function a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'name' => 'Abdelkarim Mateos',
        ]);

        $post = factory(\App\Post::class)->make([ // Make no guarda los datos, create los guarda
            'title' => 'Este es el título del post',
            'content' => 'Este es el contenido del post'
        ]);

        $user->posts()->save($post); // user_id

        //dd(route('posts.show', $post));
        // When
        $this->visit(route('posts.show', $post))  // post/99999
            ->seeInElement('h1', $post->title) // versus 'Este es el título del post' el alcance del test es el otro
            ->see($post->content)
            ->see($user->name);
    }
}

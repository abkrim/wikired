<?php

/**
 * Class CreatePostsTest
 * Este fichero es parte de WikiRed
 *
 * @version 0.1
 * @link https://tamainut.com/
 * @autor AbdelKarim Mateos <abdelkarim@tamainut.com>
 * @copyright Copyright (C) 2016 Abdelkarim Mateos. All rights reserved.
 * @license LGPL
 * @license https://opensource.org/licenses/lgpl-license General Public License, version 3.0 (LGPL-3.0)
 */
class CreatePostsTest extends FeatureTestCase
{
    /**
     * @test
     */
    function a_user_create_a_post()
    {
        //$user = factory(\App\User::class)->create();
        //$user = $this->defaultUser();
        // Having
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser());

        // When
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');

        // Then
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
            'slug'  => 'esta-es-una-pregunta'
        ]);

        // Test user is redirected to posts details after creating it.
        //$this->seeInElement('h1', $title);
        $this->see($title);
    }

    /**
     * @test
     */
    function creating_a_post_requires_authentication()
    {
        /*
        // when
        $this->visit(route('posts.create'));
        // Then
        $this->seePageIs(route('login'));
        */
        // Reduccion
        $this->visit(route('posts.create'))->seePageIs(route('login'));
    }

    /**
     * @test
     */
    function create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())->visit(route('posts.create'))->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeErrors([
                'title' => 'El campo título es obligatorio',
                'content' => 'El campo contenido es obligatorio'
            ]);
            /*
            ->seeInElement('#field_title.has-error .help-block', 'El campo título es obligatorio')
            ->seeInElement('#field_content.has-error .help-block', 'El campo contenido es obligatorio')
            */
        ;
    }
}
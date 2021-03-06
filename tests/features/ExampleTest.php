<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends FeatureTestCase
{
    //use DatabaseMigrations;
    // Ya esta en la clase extendida
    use DatabaseTransactions;  // usa transacciones por lo que alfinal del test no se ejecuta contenido
    /**
     * A basic functional test example.
     * @test
     * @return void
     */
    function basic_example()
    {
        $name   = 'AbdelKarim Mateos';
        $email  = 'abdelkarim@tamainut.com';

        $user = factory(\App\User::class)->create([
            'name'  => $name,
            'email' => $email,
        ]);

        $this->actingAs($user, 'api')
             ->visit('api/user')
             ->see($name)
             ->see($email);
    }
}

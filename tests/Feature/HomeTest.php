<?php

namespace Tests\Feature;


use Tests\TestCase;

class HomeTest extends TestCase
{

    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertSeeText('Home Page');
        $response->assertSeeText('laravel course');
    }
    public function testAboutPage()
    {
        $response = $this->get('/about');

        $response->assertSeeText('about me');
    }
}

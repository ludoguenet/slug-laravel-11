<?php

declare(strict_types=1);

use App\Models\Post;
use function Pest\Laravel\assertDatabaseCount;

it('can generate a slug', function () {
    $this->withoutExceptionHandling();

    $this->post('/posts', [
        'title' => 'Mon super article',
    ])->assertOk();

    assertDatabaseCount('posts', 1);

    $post = Post::first();
    expect($post->slug)->toBe('mon-super-article');
})->only();

it('can generate a slug that exists already', function () {
    $this->withoutExceptionHandling();

    Post::factory()->create(['title' => 'Mon super article']);
    Post::factory()->create(['title' => 'Mon super article']);

    $this->post('/posts', [
        'title' => 'Mon super article',
    ])->assertOk();

    assertDatabaseCount('posts', 3);

    $post = Post::find(3);
    expect($post->slug)->toBe('mon-super-article-2');
})->only();

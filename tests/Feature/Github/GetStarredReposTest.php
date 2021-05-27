<?php

namespace Tests\Feature\Github;

use App\User;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class GetStarredReposTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_the_users_starred_repos()
    {
        $this->mock(GitHubManager::class, function ($mock) {
            $mock->shouldReceive('authenticate')->once();
            $mock->shouldReceive('me')->once();
        });

        $user = factory(User::class)
            ->create(['github_token' => Str::random(10)]);

        $this->actingAs($user)
            ->getJson('/auth/starredGithubRepos')
            ->assertOk();
    }

    /** @test */
    public function it_returns_a_400_for_user_without_github_token()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->getJson('/auth/starredGithubRepos')
            ->assertStatus(400)
            ->assertJson(['message' => 'No github token has been added yet.']);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_use_endpoint()
    {
        $this->getJson('/auth/starredGithubRepos')
            ->assertUnauthorized();
    }
}

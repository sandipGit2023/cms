<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_displays_the_page_index()
    {
        $this->actingAsUser();

        Page::factory()->count(3)->create();

        $this->get(route('pages.index'))
            ->assertInertia(fn (Assert $page) =>
                $page->component('Pages/Index')
                    ->has('pages', 3)
            );
    }

    /** @test */
    public function it_can_create_a_page()
    {
        $this->actingAsUser();

        $pageData = [
            'title' => 'Test Page',
            'slug'  => 'test-page',
        ];

        $this->post(route('pages.store'), $pageData)
            ->assertRedirect(route('pages.index'));

        $this->assertDatabaseHas('pages', $pageData);
    }

    /** @test */
    public function it_validates_page_creation()
    {
        $this->actingAsUser();

        $this->post(route('pages.store'), [])
            ->assertSessionHasErrors(['slug', 'title']);
    }

    /** @test */
    public function it_can_edit_a_page()
    {
        $this->actingAsUser();

        $page = Page::factory()->create();

        $this->get(route('pages.edit', $page))
            ->assertInertia(fn (Assert $pageData) =>
                $pageData->component('Pages/Edit')
                         ->where('page.id', $page->id)
            );
    }

    /** @test */
    public function it_can_update_a_page()
    {
        $this->actingAsUser();

        $page = Page::factory()->create();
        $updatedData = ['title' => 'Updated Title', 'slug' => 'updated-slug'];

        $this->put(route('pages.update', $page), $updatedData)
            ->assertRedirect(route('pages.index'));

        $this->assertDatabaseHas('pages', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_page()
    {
        $this->actingAsUser();

        $page = Page::factory()->create();

        $this->delete(route('pages.destroy', $page))
            ->assertRedirect(route('pages.index'));

        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_page()
    {
        $this->actingAsUser();

        $this->get(route('pages.show', ['page' => 999999]))
            ->assertNotFound();
    }
}

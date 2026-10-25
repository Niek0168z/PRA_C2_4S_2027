<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminManualAccessTest extends TestCase
{
    public function test_manual_form_requires_authentication(): void
    {
        $this->get(route('admin.manuals.create'))
            ->assertRedirect(route('login'));

        $this->post(route('admin.manuals.store'))
            ->assertRedirect(route('login'));
    }

    public function test_login_page_is_available_to_guests(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Inloggen');
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_hash_password()
    {
        $admin = Admin::factory()->create(['password' => 'plain-text-password']);

        $this->assertTrue(Hash::check('plain-text-password', $admin->password));
    }

    /** @test */
    public function it_can_identify_as_admin()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isUser());
    }

    /** @test */
    public function it_can_identify_as_user()
    {
        $admin = Admin::factory()->create(['role' => 'user']);

        $this->assertFalse($admin->isAdmin());
        $this->assertTrue($admin->isUser());
    }

}
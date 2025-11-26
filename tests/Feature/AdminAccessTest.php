<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    // Create roles
    $adminRole = Role::create(['name' => 'admin']);
    $editorRole = Role::create(['name' => 'editor']);

    // Create permissions
    $permissions = ['manage-users', 'manage-pages', 'manage-testimonials', 'manage-settings'];
    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }

    // Assign all permissions to admin
    $adminRole->givePermissionTo(Permission::all());
    // Assign limited permissions to editor
    $editorRole->givePermissionTo(['manage-pages', 'manage-testimonials']);
});

test('admin dashboard requires authentication', function () {
    $response = $this->get(route('admin.dashboard'));

    $response->assertRedirect(route('login'));
});

test('admin dashboard requires role', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertStatus(403);
});

test('user can be assigned admin role', function () {
    $user = User::factory()->create();
    $user->assignRole('admin');

    expect($user->hasRole('admin'))->toBeTrue();
    expect($user->hasPermissionTo('manage-users'))->toBeTrue();
});

test('user can be assigned editor role', function () {
    $user = User::factory()->create();
    $user->assignRole('editor');

    expect($user->hasRole('editor'))->toBeTrue();
    expect($user->hasPermissionTo('manage-pages'))->toBeTrue();
    expect($user->hasPermissionTo('manage-users'))->toBeFalse();
});

test('editor cannot access users management', function () {
    $user = User::factory()->create();
    $user->assignRole('editor');

    $response = $this->actingAs($user)->get(route('admin.users.index'));

    $response->assertStatus(403);
});

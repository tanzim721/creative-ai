<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    if ($this->user()->email === 'adplay@mobile.com') {
        $response->assertRedirect(route('admin.dashboard'));
    } else {
        $response->assertRedirect(route('dashboard'));
    }
});

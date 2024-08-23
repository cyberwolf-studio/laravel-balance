<?php

use Workbench\App\Models\User;

beforeEach(function () {
    $user = (new User());
    $user->save();
    $this->user = $user;
});

test('user balance can be increased', function () {
    /** @var User $user */
    $user = $this->user;
    $user->increaseBalance(100);
    expect($user->balance)->toBe(100);
});

test('user balance can be decreased', function () {
    /** @var User $user */
    $user = $this->user;
    $user->decreaseBalance(100);
    expect($user->balance)->toBe(-100);
});

test('user balance can be reset', function () {
    /** @var User $user */
    $user = $this->user;
    $user->increaseBalance(100);
    expect($user->balance)->toBe(100);
    $user->resetBalance(50);
    expect($user->balance)->toBe(50);
});


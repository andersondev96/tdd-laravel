<?php

it('has example page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test("it shouldn't be able to do something weird", function () {

    expect(true)->toBe(true);
});

<?php

use App\Models\Veiculo;

it('listar todos os veículos', function () {
    $response = $this->getJson('/api/v1/veiculos');

    $response->assertStatus(200);
});

it('visualizar veículo', function () {
    $veiculo = Veiculo::inRandomOrder()->first();

    $response = $this->getJson("/api/v1/veiculos/{$veiculo->id}");

    $response->assertStatus(200)
        ->assertJsonFragment([
            'id' => $veiculo->id,
            'brand' => $veiculo->brand,
            'model' => $veiculo->model,
        ]);
});

it('criar novo veiculo', function () {
    $id = rand(1,100);

    $data = [
        'id' => $id,
        'brand' => 'Ford',
        'model' => 'Fiesta',
        'version' => '1.6 SE Flex',
        'year' => [
            'build' => 2020,
            'model' => 2021,
        ],
        'doors' => '4',
        'board' => 'ABC1234',
        'transmission' => 'Manual',
        'price' => '45000.00',
    ];

    $response = $this->postJson('/api/v1/veiculos', $data);

    $response->assertStatus(201)
        ->assertJsonFragment([
            'brand' => 'Ford',
            'model' => 'Fiesta',
        ]);

    $this->assertDatabaseHas('veiculos', [
        'id' => $id,
        'brand' => 'Ford',
    ]);
});

it('Atualizar veiculo', function () {
    $veiculo = Veiculo::inRandomOrder()->first();

    $updateData = [
        'type' => 'Moto',
        'brand' => 'Honda',
        'model' => 'CB 500',
    ];

    $response = $this->putJson("/api/v1/veiculos/{$veiculo->id}", $updateData);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'type' => 'Moto',
            'brand' => 'Honda',
            'model' => 'CB 500',
        ]);

    $this->assertDatabaseHas('veiculos', [
        'id' => $veiculo->id,
        'type' => 'Moto',
        'brand' => 'Honda',
        'model' => 'CB 500',
    ]);
});

it('Excluir Veículo', function () {
    $veiculo = Veiculo::inRandomOrder()->first();

    $response = $this->deleteJson("/api/v1/veiculos/{$veiculo->id}");

    $response->assertStatus(200);

    $this->assertDatabaseMissing('veiculos', [
        'id' => $veiculo->id,
    ]);
});

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    public function test_has_resource()
    {
        $response = $this->get('/api/resources');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'resources' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'snippet',
                        'link',
                        'new_tab',
                        'file_name',
                        'path',
                        'type',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    public function test_resource_not_found()
    {
        $response = $this->get('/api/resources/invalidId/edit');

        $response
            ->assertStatus(404)
            ->assertExactJson([
                'message' => 'Resource not found.'
            ]);
    }

    public function test_create_link_resource()
    {
        $response = $this->post('/api/resources', ['title' => 'Test Link', 'link' => 'https://test.link', 'new_tab' => false, 'type' => 'link']);
        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Resource created successfully.'
            ]);
    }

    public function test_resource_creation_validation()
    {
        $response = $this->postJson('/api/resources', ['link' => 'https://test.link', 'new_tab' => false, 'type' => 'link']);
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }
}

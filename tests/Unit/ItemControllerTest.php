<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsString;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testEnvironmentSetup()
    {
        $this->assertEquals('testing', app()->environment());
        $this->assertEquals('sqlite', config('database.default'));
    }

    /** @test */
    public function it_displays_items_on_the_index_page()
    {
        //Create a user with a password
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt($password),
        ]);

        // Generate CSRF token manually
        $csrfToken = csrf_token();

        // Act: Attempt to log in with the correct credentials, including CSRF token
        $response = $this->post('/login', [
            '_token' => $csrfToken, // Include the CSRF token
            'email' => $user->email,
            'password' => $password,
        ]);

        // Arrange: Create some items
        $items = Item::factory()->count(3)->create();

        // Act: Access the index page
        $response = $this->get('/items');

        // Assert: The page is accessible and items are displayed
        $response->assertStatus(200);
        $response->assertViewIs('items.index');
        $response->assertSee($items[0]->name);
        $response->assertSee($items[1]->name);
        $response->assertSee($items[2]->name);
    }

    /** @test */
    public function it_can_create_a_new_item()
    {
        //Create a user with a password
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt($password),
        ]);

        // Generate CSRF token manually
        $csrfToken = csrf_token();

        // Act: Attempt to log in with the correct credentials, including CSRF token
        $response = $this->post('/login', [
            '_token' => $csrfToken, // Include the CSRF token
            'email' => $user->email,
            'password' => $password,
        ]);

        // Arrange: Create a new item data
        $itemData = [
            'barcode' => '123456789',
            'name' => 'Test Item',
            'price' => 9.99,
        ];

        // Assert: That the user can get to the create form
        $response = $this->get('/items/create');

        assertEquals($response->status(), 200);

        $response = $this->post('/items', $itemData);

        // Assert: There is an item with the same name, barcode and price in the db as the one
        // just created

        $foundItem = Item::where('name', '=', $itemData['name'])->first();
        assertEquals($itemData['barcode'], $foundItem->barcode);
        assertEquals($itemData['name'], $foundItem->name);
        assertEquals($itemData['price'], $foundItem->price);
    }

    /** @test */
    public function it_can_upate_an_item()
    {
        //Create a user with a password
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt($password),
        ]);

        // Generate CSRF token manually
        $csrfToken = csrf_token();

        // Act: Attempt to log in with the correct credentials, including CSRF token
        $response = $this->post('/login', [
            '_token' => $csrfToken, // Include the CSRF token
            'email' => $user->email,
            'password' => $password,
        ]);

        // Arrange: Create a new item data
        $itemData = [
            'barcode' => '123456789',
            'name' => 'Test Item',
            'price' => 9.99,
        ];

        // Assert: That the user can get to the create form
        $response = $this->get('/items/create');

        assertEquals($response->status(), 200);

        $response = $this->post('/items', $itemData);

        // Assert: There is an item with the same name, barcode and price in the db as the one
        // just created

        $createdItem = Item::where('name', '=', $itemData['name'])->first();
        assertEquals($itemData['barcode'], $createdItem->barcode);
        assertEquals($itemData['name'], $createdItem->name);
        assertEquals($itemData['price'], $createdItem->price);

        // Assert: That the user can get to the update form
        $response = $this->get('/items/' . $createdItem->id . '/edit');

        assertEquals($response->status(), 200);

        $itemDataUpdated = [
            'barcode' => '1234567890',
            'name' => 'Test ItemX',
            'price' => 10.77,
        ];

        // Assert: The items are the same as the one being updated
        $this->put(route('items.update', $createdItem->id), $itemDataUpdated);

        $updatedItem = Item::where('name', '=', $itemDataUpdated['name'])->first();

        assertEquals($itemDataUpdated['barcode'], $updatedItem->barcode);
        assertEquals($itemDataUpdated['name'], $updatedItem->name);
        assertEquals($itemDataUpdated['price'], $updatedItem->price);
    }

    /** @test */
    public function it_can_delete_an_item() {
     // Create a user and an item
     $user = User::factory()->create();
     $item = Item::factory()->create();
 
     // Assert that the name and description are strings
     assertIsString($item->name);
     assertIsString($item->description);
    
     $response = $this->actingAs($user)->delete(route('items.destroy', $item->id), [
        '_token' => csrf_token(),
    ]);

     // Assert the item was deleted
     $response->assertRedirect(route('items.index'));

     assertEquals(Item::count(),0);
    }
}

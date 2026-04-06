<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Menu;
use App\Services\MenuItemService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuItemServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected MenuItemService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new MenuItemService();
    }

    public function test_it_can_get_all_menu_items()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        MenuItem::create([
            'category_id' => $category->id,
            'name' => 'Burger',
            'price' => 10.99,
            'status' => 'available'
        ]);

        $result = $this->service->getAll();

        $this->assertGreaterThan(0, $result->count());
        $this->assertNotNull($result->first()->category);
    }

    public function test_it_can_get_menu_item_by_id()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        $item = MenuItem::create([
            'category_id' => $category->id,
            'name' => 'Pizza',
            'price' => 12.99,
            'status' => 'available'
        ]);

        $result = $this->service->getById($item->id);

        $this->assertEquals($item->id, $result->id);
        $this->assertEquals('Pizza', $result->name);
    }

    public function test_it_can_create_a_menu_item()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        $data = [
            'category_id' => $category->id,
            'name' => 'Pasta',
            'price' => 8.50,
            'status' => 'available'
        ];

        $item = $this->service->create($data);

        $this->assertDatabaseHas('menu_items', [
            'id' => $item->id,
            'name' => 'Pasta',
        ]);
    }

    public function test_it_can_update_a_menu_item()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        $item = MenuItem::create([
            'category_id' => $category->id,
            'name' => 'Old Name',
            'price' => 5.00,
            'status' => 'available'
        ]);

        $updatedData = ['name' => 'New Name'];

        $this->service->update($item->id, $updatedData);

        $this->assertDatabaseHas('menu_items', [
            'id' => $item->id,
            'name' => 'New Name',
        ]);
    }

    public function test_it_can_delete_a_menu_item()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        $item = MenuItem::create([
            'category_id' => $category->id,
            'name' => 'To Delete',
            'price' => 1.00,
            'status' => 'available'
        ]);

        $this->service->delete($item->id);

        $this->assertDatabaseMissing('menu_items', [
            'id' => $item->id,
        ]);
    }

    public function test_it_can_get_by_category()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Specific Cat', 'display_order' => 1]);
        MenuItem::create([
            'category_id' => $category->id,
            'name' => 'Item X',
            'price' => 10.00,
            'status' => 'available'
        ]);

        $result = $this->service->getByCategory($category->id);

        $this->assertGreaterThan(0, $result->count());
        foreach ($result as $item) {
            $this->assertEquals($category->id, $item->category_id);
            $this->assertEquals('available', $item->status);
        }
    }

    public function test_it_can_update_availability()
    {
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        $item = MenuItem::create([
            'category_id' => $category->id,
            'name' => 'Item Y',
            'price' => 10.00,
            'status' => 'available'
        ]);

        $this->service->updateAvailability($item->id, 'unavailable');

        $this->assertDatabaseHas('menu_items', [
            'id' => $item->id,
            'status' => 'unavailable',
        ]);
    }
}

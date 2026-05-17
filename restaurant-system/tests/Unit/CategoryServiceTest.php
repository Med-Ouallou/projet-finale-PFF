<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Menu;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected CategoryService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CategoryService();
    }

    public function test_it_can_get_all_categories()
    {
        $menu = Menu::create(['name' => 'Test Menu']);
        Category::create([
            'menu_id' => $menu->id,
            'name' => 'Category A',
            'display_order' => 1,
            'is_active' => true
        ]);

        $result = $this->service->getAll();
        
        $this->assertGreaterThan(0, $result->count());
        $this->assertInstanceOf(Category::class, $result->first());
    }

    public function test_it_can_get_category_by_id()
    {
        $menu = Menu::create(['name' => 'Test Menu']);
        $category = Category::create([
            'menu_id' => $menu->id,
            'name' => 'Test Category',
            'display_order' => 1,
            'is_active' => true
        ]);

        $result = $this->service->getById($category->id);

        $this->assertEquals($category->id, $result->id);
        $this->assertEquals('Test Category', $result->name);
    }

    public function test_it_can_create_a_category()
    {
        $menu = Menu::create(['name' => 'Test Menu']);
        $data = [
            'menu_id' => $menu->id,
            'name' => 'New Category',
            'display_order' => 5,
            'is_active' => true
        ];

        $category = $this->service->create($data);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'New Category',
        ]);
    }

    public function test_it_can_update_a_category()
    {
        $menu = Menu::create(['name' => 'Test Menu']);
        $category = Category::create([
            'menu_id' => $menu->id,
            'name' => 'Old Name',
            'display_order' => 1,
            'is_active' => true
        ]);

        $updatedData = [
            'name' => 'Updated Name',
        ];

        $this->service->update($category->id, $updatedData);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_it_can_delete_a_category()
    {
        $menu = Menu::create(['name' => 'Test Menu']);
        $category = Category::create([
            'menu_id' => $menu->id,
            'name' => 'To Delete',
            'display_order' => 1,
            'is_active' => true
        ]);

        $this->service->delete($category->id);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_it_can_get_categories_by_menu()
    {
        $menu = Menu::create(['name' => 'Specific Menu']);
        Category::create([
            'menu_id' => $menu->id,
            'name' => 'Category in Menu',
            'display_order' => 1,
            'is_active' => true
        ]);

        $result = $this->service->getByMenu($menu->id);

        $this->assertGreaterThan(0, $result->count());
        foreach ($result as $category) {
            $this->assertEquals($menu->id, $category->menu_id);
            $this->assertTrue((bool)$category->is_active);
        }
    }
}

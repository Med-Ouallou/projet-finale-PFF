<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected MenuService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new MenuService();
    }

    public function test_it_can_get_all_menus()
    {
        Menu::create([
            'name' => 'Menu A',
            'display_order' => 2,
            'is_active' => true
        ]);
        Menu::create([
            'name' => 'Menu B',
            'display_order' => 1,
            'is_active' => true
        ]);

        $result = $this->service->getAll();

        $this->assertGreaterThan(1, $result->count());
        $this->assertTrue($result->contains('name', 'Menu A'));
        $this->assertTrue($result->contains('name', 'Menu B'));
        
        $menuA = $result->firstWhere('name', 'Menu A');
        $menuB = $result->firstWhere('name', 'Menu B');
        
        // Ensure Menu B (display_order 1) comes before Menu A (display_order 2)
        $this->assertLessThan($result->search($menuA), $result->search($menuB));
    }

    public function test_it_can_get_menu_by_id()
    {
        $menu = Menu::create([
            'name' => 'Specific Menu',
            'display_order' => 1,
            'is_active' => true
        ]);

        $result = $this->service->getById($menu->id);

        $this->assertEquals($menu->id, $result->id);
    }

    public function test_it_can_create_a_menu()
    {
        $data = [
            'name' => 'New Menu',
            'display_order' => 5,
            'is_active' => true
        ];

        $menu = $this->service->create($data);

        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'name' => 'New Menu',
        ]);
    }

    public function test_it_can_update_a_menu()
    {
        $menu = Menu::create([
            'name' => 'Old Menu',
            'display_order' => 1,
            'is_active' => true
        ]);

        $this->service->update($menu->id, ['name' => 'Updated Menu']);

        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'name' => 'Updated Menu',
        ]);
    }

    public function test_it_can_delete_a_menu()
    {
        $menu = Menu::create([
            'name' => 'To Delete',
            'display_order' => 1,
            'is_active' => true
        ]);

        $this->service->delete($menu->id);

        $this->assertDatabaseMissing('menus', [
            'id' => $menu->id,
        ]);
    }

    public function test_it_can_get_active_menus()
    {
        Menu::create([
            'name' => 'Active Menu',
            'is_active' => true,
            'display_order' => 1
        ]);
        Menu::create([
            'name' => 'Inactive Menu',
            'is_active' => false,
            'display_order' => 2
        ]);

        $result = $this->service->getActiveMenus();

        foreach ($result as $menu) {
            $this->assertTrue((bool)$menu->is_active);
        }
    }
}

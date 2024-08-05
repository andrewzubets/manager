<?php

namespace Data\MenuManager;

use App\Api\Menu\MenuManager;
use Tests\TestCase;

class MenuManagerTest extends TestCase
{
    public const
        TEST_ROUTE_1 = 'test-stub-1',
        TEST_ROUTE_2 = 'test-stub-2',
        TEST_ROUTE_ARG = 'test-stub-arg';

    public const TEST_ROUTE_ARGUMENT = [123];

    /**
     * A basic unit test example.
     */
    public function test_simple(): void
    {
        $menuManager = new MenuManager([
            'left'=>[
                [
                    'trans' => 'navigation/top-menu.home',
                    'route' => self::TEST_ROUTE_1,
                ],
                [
                    'trans' => 'navigation/top-menu.home',
                    'route' => self::TEST_ROUTE_ARG,
                    'route_args' => self::TEST_ROUTE_ARGUMENT
                ]
            ]
        ]);

        $this->assertHasNoMenu($menuManager, 'not_existing');
        $this->assertHasMenu($menuManager, 'left');
        $menuItems = $menuManager->getMenu('left');
        $this->assertCount(2, $menuItems);
        $menuItem = $menuItems[0];
        $this->assertValidMenuItem($menuItem, isSub: false, expectData: [
            'label' => trans('navigation/top-menu.home'),
            'href' => \route(self::TEST_ROUTE_1),
        ]);

        $menuItem2 = $menuItems[1];
        $this->assertValidMenuItem($menuItem2, isSub: false, expectData: [
            'label' => trans('navigation/top-menu.home'),
            'href' => \route(self::TEST_ROUTE_ARG, self::TEST_ROUTE_ARGUMENT),
        ]);

    }

    /**
     * Href and label property priority.
     */
    public function test_priority(): void
    {
        $menuManager = new MenuManager([
            'left'=>[
                [
                    'trans' => 'navigation/top-menu.home',
                    'label' => 'Home page',
                    'href' => '/',
                    'route' => self::TEST_ROUTE_1,
                ]
            ]
        ]);
        $this->assertHasMenu($menuManager, 'left');
        $menuItems = $menuManager->getMenu('left');
        $this->assertCount(1, $menuItems);
        $menuItem = $menuItems[0];
        $this->assertValidMenuItem($menuItem, isSub: false, expectData: [
            'href' => '/',
            'label' => 'Home page'
        ]);
    }

    /**
     * Sub menu test.
     */
    public function test_sub(): void
    {
        $menuManager = new MenuManager([
            'left'=>[
                [
                    'label' => 'Route 1',
                    'route' => self::TEST_ROUTE_1,
                ],
                [
                    'label' => 'Sub',
                    'route' => self::TEST_ROUTE_2,
                    'sub' => [
                        [
                            'label' => 'Route 2',
                            'route' => self::TEST_ROUTE_ARG,
                            'route_args' => self::TEST_ROUTE_ARGUMENT,
                        ],
                    ]
                ],
            ]
        ]);

        $this->assertHasMenu($menuManager, 'left');
        $menuItems = $menuManager->getMenu('left');
        $this->assertCount(2, $menuItems);
        $menuItem = $menuItems[0];
        $this->assertValidMenuItem($menuItem, isSub: false, expectData: [
            'href' => \route(self::TEST_ROUTE_1),
            'label' => 'Route 1',
        ]);
        $keys = array_keys($menuItem);
        $this->assertNotContains('sub', $keys);

        $subMenuItem = $menuItems[1];
        $this->assertValidMenuItem($subMenuItem, isSub: true, expectData: [
            'href' => \route(self::TEST_ROUTE_2),
            'label' => 'Sub',
        ]);
        $this->assertCount(1, $subMenuItem['sub']);
        $subMenuItem1 = $subMenuItem['sub'][0];
        $this->assertEquals(
            \route(self::TEST_ROUTE_ARG,self::TEST_ROUTE_ARGUMENT),
            $subMenuItem1['href']
        );
        $this->assertEquals('Route 2', $subMenuItem1['label']);
    }

    public function test_absolute(): void {
        $menuManager = new MenuManager([
            'left'=>[
                [
                    'label' => 'Route 1',
                    'route' => self::TEST_ROUTE_1,
                ],
                [
                    'label' => 'Sub',
                    'route' => self::TEST_ROUTE_2,
                    'sub' => [
                        [
                            'label' => 'Route 2',
                            'route' => self::TEST_ROUTE_ARG,
                            'route_args' => self::TEST_ROUTE_ARGUMENT,
                        ],
                    ]
                ],
            ]
        ]);
        $this->assertHasMenu($menuManager, 'left');
        // Absolute.
        $menuItems = $menuManager->getMenu('left');
        $this->assertCount(2, $menuItems);
        $this->assertEquals(route(self::TEST_ROUTE_1), $menuItems[0]['href']);
        $this->assertEquals(
            route(self::TEST_ROUTE_ARG, self::TEST_ROUTE_ARGUMENT),
            $menuItems[1]['sub'][0]['href']
        );

        // Relative.
        $menuItems = $menuManager->getMenu('left', false);
        $this->assertCount(2, $menuItems);
        $this->assertEquals(route(self::TEST_ROUTE_1,[], false), $menuItems[0]['href']);
        $this->assertEquals(
            route(self::TEST_ROUTE_ARG, self::TEST_ROUTE_ARGUMENT, false),
            $menuItems[1]['sub'][0]['href']
        );
    }

    private function assertHasMenu(MenuManager $menuManager, string $menuName): void {
        $menuItems = $menuManager->getMenu($menuName);
        $this->assertNotEmpty($menuItems, 'Menu should have items.');
    }

    private function assertHasNoMenu(MenuManager $menuManager, string $menuName): void {
        $menuItems = $menuManager->getMenu($menuName);
        $this->assertEmpty($menuItems, 'Menu should have no items.');
    }

    private function assertValidMenuItem(mixed $menuItem, bool $isSub = false, array $expectData = []): void
    {
        $this->assertNotEmpty($menuItem, 'Menu item cant be empty.');
        $this->assertTrue(
            isset($menuItem['label']) || isset($menuItem['trans']),
            'Menu item should have label or trans.');
        $this->assertTrue(
            isset($menuItem['href']) || isset($menuItem['route']),
            'Menu item should have href or route.'
        );
        if($isSub) {
            $this->assertArrayHasKey('sub', $menuItem, 'Sub menu item should have sub property.');
        }
        foreach ($expectData as $propId => $expectedValue) {
            $this->assertEquals($expectedValue, $menuItem[$propId]);
        }
    }
}

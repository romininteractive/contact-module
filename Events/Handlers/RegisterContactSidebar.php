<?php

namespace Modules\Contact\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterContactSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('contact::contacts.title.contacts'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('contact::contacts.title.vendors'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.contact.contacts.create');
                    $item->route('admin.contact.contact.index', ['type' => 'vendor']);
                    $item->authorize(
                        $this->auth->hasAccess('contact.contacts.index')
                    );
                });

                $item->item(trans('contact::contacts.title.customers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.contact.contacts.create');
                    $item->route('admin.contact.contact.index', ['type' => 'customer']);
                    $item->authorize(
                        $this->auth->hasAccess('contact.contacts.index')
                    );
                });

            });
        });

        return $menu;
    }
}

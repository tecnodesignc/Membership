<?php

namespace Modules\Membership\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterMembershipSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('membership::memberships.title.memberships'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('membership::professions.title.professions'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.profession.create');
                    $item->route('admin.membership.profession.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.professions.index')
                    );
                });
                $item->item(trans('membership::districts.title.districts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.district.create');
                    $item->route('admin.membership.district.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.districts.index')
                    );
                });
                $item->item(trans('membership::congregations.title.congregations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.congregation.create');
                    $item->route('admin.membership.congregation.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.congregations.index')
                    );
                });
                $item->item(trans('membership::committees.title.committees'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.committee.create');
                    $item->route('admin.membership.committee.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.committees.index')
                    );
                });
                $item->item(trans('membership::workstations.title.workstations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.workstation.create');
                    $item->route('admin.membership.workstation.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.workstations.index')
                    );
                });
                $item->item(trans('membership::profiles.title.profiles'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.profile.create');
                    $item->route('admin.membership.profile.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.profiles.index')
                    );
                });
                $item->item(trans('membership::addresses.title.addresses'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.membership.address.create');
                    $item->route('admin.membership.address.index');
                    $item->authorize(
                        $this->auth->hasAccess('membership.addresses.index')
                    );
                });
// append







            });
        });

        return $menu;
    }
}

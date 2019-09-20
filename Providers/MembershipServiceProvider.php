<?php

namespace Modules\Membership\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Membership\Events\Handlers\RegisterMembershipSidebar;

class MembershipServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterMembershipSidebar::class);

       /* $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('professions', array_dot(trans('membership::professions')));
            $event->load('districts', array_dot(trans('membership::districts')));
            $event->load('congregations', array_dot(trans('membership::congregations')));
            $event->load('committees', array_dot(trans('membership::committees')));
            $event->load('workstations', array_dot(trans('membership::workstations')));
            $event->load('profiles', array_dot(trans('membership::profiles')));
            $event->load('addresses', array_dot(trans('membership::addresses')));
            $event->load('studies', array_dot(trans('membership::studies')));
        });*/
    }

    public function boot()
    {
        $this->publishConfig('membership', 'permissions');
        $this->publishConfig('membership', 'config');
        $this->publishConfig('membership', 'settings');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Membership\Repositories\ProfessionRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentProfessionRepository(new \Modules\Membership\Entities\Profession());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheProfessionDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\DistrictRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentDistrictRepository(new \Modules\Membership\Entities\District());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheDistrictDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\CongregationRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentCongregationRepository(new \Modules\Membership\Entities\Congregation());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheCongregationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\CommitteeRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentCommitteeRepository(new \Modules\Membership\Entities\Committee());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheCommitteeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\WorkstationRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentWorkstationRepository(new \Modules\Membership\Entities\Workstation());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheWorkstationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\ProfileRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentProfileRepository(new \Modules\Membership\Entities\Profile());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheProfileDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\AddressRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentAddressRepository(new \Modules\Membership\Entities\Address());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheAddressDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Membership\Repositories\StudyRepository',
            function () {
                $repository = new \Modules\Membership\Repositories\Eloquent\EloquentStudyRepository(new \Modules\Membership\Entities\Study());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Membership\Repositories\Cache\CacheStudyDecorator($repository);
            }
        );
    }
}

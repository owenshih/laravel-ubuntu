<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repositories\Hotel\HotelInterface;
use App\Repositories\Hotel\EloquentHotel;

use App\Repositories\City\CityInterface;
use App\Repositories\City\EloquentCity;

use App\Repositories\Town\TownInterface;
use App\Repositories\Town\EloquentTown;

use App\Repositories\Funding\FundingInterface;
use App\Repositories\Funding\EloquentFunding;

use App\Repositories\FundingItem\FundingItemInterface;
use App\Repositories\FundingItem\EloquentFundingItem;

use App\Repositories\ShortMessageServiceExample\ShortMessageServiceExampleInterface;
use App\Repositories\ShortMessageServiceExample\EloquentShortMessageServiceExample;

use App\Repositories\ShortMessageServiceHistory\ShortMessageServiceHistoryInterface;
use App\Repositories\ShortMessageServiceHistory\EloquentShortMessageServiceHistory;

use App\Repositories\HotelCooperation\HotelCooperationInterface;
use App\Repositories\HotelCooperation\EloquentHotelCooperation;

use App\Repositories\HotelReturn\HotelReturnInterface;
use App\Repositories\HotelReturn\EloquentHotelReturn;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HotelInterface::class, EloquentHotel::class);
        $this->app->bind(CityInterface::class, EloquentCity::class);
        $this->app->bind(TownInterface::class, EloquentTown::class);
        $this->app->bind(FundingInterface::class, EloquentFunding::class);
        $this->app->bind(FundingItemInterface::class, EloquentFundingItem::class);
        $this->app->bind(ShortMessageServiceExampleInterface::class, EloquentShortMessageServiceExample::class);
        $this->app->bind(ShortMessageServiceHistoryInterface::class, EloquentShortMessageServiceHistory::class);
        $this->app->bind(HotelCooperationInterface::class, EloquentHotelCooperation::class);
        $this->app->bind(HotelReturnInterface::class, EloquentHotelReturn::class);
    }
}

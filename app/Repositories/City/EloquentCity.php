<?php
namespace App\Repositories\City;
use App\Repositories\City\CityInterface as CityInterface;
use App\City;

class EloquentCity implements CityInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     * @param App\City $model
     */
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /**
     * Get all tasks.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

}
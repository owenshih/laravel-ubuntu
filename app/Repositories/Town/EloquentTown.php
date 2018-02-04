<?php
namespace App\Repositories\Town;
use App\Repositories\Town\TownInterface as TownInterface;
use App\Town;

class EloquentTown implements TownInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     * @param App\Town $model
     */
    public function __construct(Town $model)
    {
        $this->model = $model;
    }

    /**
     * Get task by id.
     *
     * @param integer $id
     *
     * @return App\Task
     */
    public function getById($id)
    {
        return $this->model->where('city_id', $id)->get();
    }


}
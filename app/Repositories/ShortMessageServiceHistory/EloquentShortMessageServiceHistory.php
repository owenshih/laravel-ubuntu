<?php
namespace App\Repositories\ShortMessageServiceHistory;
use App\Repositories\ShortMessageServiceHistory\ShortMessageServiceHistoryInterface as ShortMessageServiceHistoryInterface;
use App\ShortMessageServiceHistory;

class EloquentShortMessageServiceHistory implements ShortMessageServiceHistoryInterface
{

    private $model;

    public function __construct(ShortMessageServiceHistory $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->where('status', '!=', -1)->paginate(10);
    }

    public function create($attributes)
    {
        return $this->model->create($attributes->all());
    }

}
<?php
namespace App\Repositories\ShortMessageServiceExample;
use App\Repositories\ShortMessageServiceExample\ShortMessageServiceExampleInterface as ShortMessageServiceExampleInterface;
use App\ShortMessageServiceExample;

class EloquentShortMessageServiceExample implements ShortMessageServiceExampleInterface
{

    private $model;

    public function __construct(ShortMessageServiceExample $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->where('status', '!=', -1)->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes)
    {
        return $this->model->create($attributes->all());
    }

    public function update($id, $attributes)
    {
        return $this->model->where('id',$id)->update([
            'title'     => $attributes['title'],
            'content'   => $attributes['content'],
        ]);
    }

    public function delete($id)
    {
        return $this->model->where('id',$id)->update(['status' => -1]);
    }

}
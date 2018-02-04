<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\City\CityInterface;

class CityController extends Controller
{
    /**
     * @var Repository
     */
    private $city;

    /**
     * CityController constructor
     * @param CityController $city
     */
    public function __construct(CityInterface $city)
    {
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->city->getAll();
    }
}

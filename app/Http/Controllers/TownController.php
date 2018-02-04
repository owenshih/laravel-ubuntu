<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Town\TownInterface;

class TownController extends Controller
{
    /**
     * @var Repository
     */
    private $town;

    /**
     * TownController constructor
     * @param TownController $town
     */
    public function __construct(TownInterface $town)
    {
        $this->town = $town;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->town->getById($id);
    }

}

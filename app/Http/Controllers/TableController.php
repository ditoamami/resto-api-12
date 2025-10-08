<?php
namespace App\Http\Controllers;

use App\Http\Requests\TableStatusRequest;
use App\Models\BookTable;
use App\Services\TableService;
use Illuminate\Http\Request;


class TableController extends Controller
{
    protected $service;

    public function __construct(TableService $s)
    {
        $this->service = $s;
    }

    public function index()
    {
        return $this->service->listTables();
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->service->updateStatus((int)$id, $request->status);
    }
}
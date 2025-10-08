<?php
namespace App\Http\Controllers;

use App\Http\Requests\TableStatusRequest;
use App\Models\BookTable;
use App\Services\TableService;

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

    public function updateStatus(BookTable $table, TableStatusRequest $req)
    {
        return $this->service->updateStatus($table->id, $req->validated()['status']);
    }
}
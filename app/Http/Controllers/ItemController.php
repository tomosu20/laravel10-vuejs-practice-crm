<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Items/Index', [
            'items' => Item::select('id', 'name', 'memo', 'price', 'is_selling')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Items/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        Item::create([
            'name' => $request->name,
            'memo' => $request->memo,
            'price' => $request->price,
        ]);

        return to_route('items.index')
            ->with([
                'message' => 'registered item success.',
                'status' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return Inertia::render('Items/Show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->name;
        $item->memo = $request->memo;
        $item->price = $request->price;
        $item->is_selling = $request->is_selling;
        $item->save();

        return to_route('items.index')
            ->with([
                'message' => 'success updated item.',
                'status' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return to_route('items.index')
            ->with([
                'message' => 'success delete item.',
                'status' => 'danger'
            ]);
    }

    public function upload()
    {
        return Inertia::render('Items/Upload');
    }

    public function csvImport(Request $request)
    {
        $this->validate($request, [
            'csv' => 'mimes:csv'
        ]);

        $file = $request->file('csvFile');

        $objReader = new Csv();
        $spreadsheet = $objReader->load($file->getPathName());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // バリデーションの処理

        $value = array();

        $header = array_shift($sheetData);

        foreach ($sheetData as $row) {
            $value[] = array_combine($header, $row);
        }

        return json_encode($value, JSON_PRETTY_PRINT);
    }

    public function bulkStore(Request $request)
    {
        // バリデーションの処理

        $items =  $request->all();

        $insert_items = [];
        foreach ($items as $item) {
            $insert_items[] = [
                'name' => $item['name'],
                'memo' => $item['memo'],
                'price' => $item['price'],
                'is_selling' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Item::insert($insert_items);

        return to_route('items.index')
            ->with([
                'message' => 'success bulk create items.',
                'status' => 'success',
            ]);
    }
}

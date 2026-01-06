<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MasterItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MasterItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class MasterItemsController extends Controller
{
    public function index()
    {
        return view('master_items.index.index');
    }

    public function indexCategories()
    {
        return view('master_items.index.index_categories');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;
        $hargamin = $request->hargamin;
        $hargamax = $request->hargamax;

        $data_search = MasterItem::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        $data_search = $data_search
            ->when($hargamin !== null, function ($q) use ($hargamin) {
                $q->where('harga_beli', '>=', $hargamin);
            })
            ->when($hargamax !== null, function ($q) use ($hargamax) {
                $q->where('harga_beli', '<=', $hargamax);
            });

        $data_search = $data_search->select('kode', 'nama', 'jenis', 'harga_beli', 'laba', 'supplier')->orderBy('id')->get();


        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);

    }

    public function searchCategories(Request $request)
    {
        $data_search = Category::with('items')
            ->when($request->filled('kode'), function ($q) use ($request) {
                $q->where('kode', 'LIKE', '%' . $request->kode . '%');
            })
            ->when($request->filled('nama'), function ($q) use ($request) {
                $q->where('nama', 'LIKE', '%' . $request->nama . '%');
            })
            ->orderBy('id')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }


    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = MasterItem::find($id);
        }
        $categorys = Category::orderBy('nama')->get();
        $data['categorys'] = $categorys;
        $data['item'] = $item;
        $data['method'] = $method;
        return view('master_items.form.index', $data);
    }

    public function formCategories($method, $id = 0)
    {
        if ($method === 'new') {
            $category = new Category();
        } else {
            $category = Category::with('items')->findOrFail($id);
        }

        $items = MasterItem::orderBy('nama')->get();

        return view('master_items.form.categories_form', [
            'category' => $category,
            'items' => $items,
            'method' => $method
        ]);
    }

    public function formCategoriesSubmit(Request $request, $method, $id = 0)
    {
        if ($method === 'new') {
            $category = new Category();
        } else {
            $category = Category::findOrFail($id);
        }

        $category->kode = $request->kode;
        $category->nama = $request->nama;
        $category->save();

        if ($request->has('items')) {
            $category->items()->sync($request->items);
        }

        return redirect('master-items');
    }

    public function show($id)
    {
        $category = Category::with('items')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function printCategoryPdf($id)
    {
        $category = Category::with('items')->findOrFail($id);

        $pdf = Pdf::loadView('categories.pdf.print', [
            'category'   => $category,
            'printed_at' => now()
        ])->setPaper('A4', 'portrait');

        return $pdf->download(
            'Kategori-' . $category->kode . '.pdf'
        );
    }


    public function singleView($kode)
    {
        $data['data'] = MasterItem::with('categories')
            ->where('kode', $kode)
            ->firstOrFail();
        return view('master_items.single.index', $data);
    }

    public function singleViewCategories($id)
    {
        $data['data'] = Category::with('items')
        ->where('id', $id)
        ->firstOrFail();

        // dd($data['data']);
        return view('master_items.single.index_categories', $data);
    }


    public function formSubmit(Request $request, $method, $id = 0)
    {

        // dd($request->all());
        if ($method == 'new') {
            $data_item = new MasterItem();

            $lastId = MasterItem::max('id') + 1;
            $kode = str_pad($lastId, 5, '0', STR_PAD_LEFT);
        } else {
            $data_item = MasterItem::findOrFail($id);
            $kode = $data_item->kode;
        }

        $data_item->nama        = $request->nama;
        $data_item->harga_beli  = $request->harga_beli;
        $data_item->laba        = $request->laba;
        $data_item->kode        = $kode;
        $data_item->supplier    = $request->supplier;
        $data_item->jenis       = $request->jenis;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('master-items', 'public');
            $data_item->foto = $path;
        }

        $data_item->save();

        if ($request->filled('categories')) {
            $data_item->categories()->sync($request->categories);
        } else {
            $data_item->categories()->detach();
        }

        return redirect('master-items');
    }


    public function delete($id)
    {
        MasterItem::find($id)->delete();
        return redirect('master-items');
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach ($data as $item) {
            $kode = $item->id;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100, 1000000);
            $item->laba = rand(10, 99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi', 'Bukulapuk', 'TokoBagas', 'E Commurz', 'Blublu'];
        $random = rand(0, 4);
        return $array[$random];
    }

    private function getRandomJenis()
    {
        $array = ['Obat', 'Alkes', 'Matkes', 'Umum', 'ATK'];
        $random = rand(0, 4);
        return $array[$random];
    }

    public function exportExcel()
{
    return Excel::download(
        new MasterItemsExport,
        'Master_Items.xlsx'
    );
}
}

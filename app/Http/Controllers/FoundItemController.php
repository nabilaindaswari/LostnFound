<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemQuestion;
use App\Models\Location;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoundItemController extends Controller
{
    public function showCatalog()
    {
        $items = Item::where('type', 'found')->latest()->paginate(12);
        return view('temuan.index', ['title' => 'Barang Temuan', 'items' => $items]);
    }
    public function createTemuan(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|max:500',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'location_detail' => 'nullable|max:500',
            'event_date' => 'required|date|before_or_equal:today',
            'kept_by' => 'required|max:100',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'questions' => 'required|array|size:4',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.option_a' => 'required|string|max:255',
            'questions.*.option_b' => 'required|string|max:255',
            'questions.*.option_c' => 'required|string|max:255',
            'questions.*.correct_option' => 'required|in:a,b,c',
        ]);

        $path = $request->file('photo')->store('items', 'public');
        $item = DB::transaction(function () use ($data, $path) {
            $item = Item::create([
                'type' => 'found',
                'user_id' => auth()->id(),
                'category_id' => $data['category_id'],
                'location_id' => $data['location_id'],
                'name' => $data['name'],
                'description' => $data['description'],
                'location_detail' => $data['location_detail'] ?? null,
                'event_date' => $data['event_date'],
                'kept_by' => $data['kept_by'],
                'photo' => $path,

                // 'status' => $data['status'],
            ]);

            foreach ($data['questions'] as $order => $q) {
                ItemQuestion::create([
                    'item_id' => $item->id,
                    'order' => $order + 1,
                    'question' => $q['question'],
                    'option_a' => $q['option_a'],
                    'option_b' => $q['option_b'],
                    'option_c' => $q['option_c'],
                    'correct_option' => $q['correct_option'],
                ]);

            }
            return $item;
        });
        return redirect()->route('temuan.show', ['id' => $item->id])->with('success', 'Laporan berhasil dibuat');
    }
    public function showCreate()
    {
        return view('temuan.create', [
            'categories' => Category::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
        ]);
    }
    public function showid($id)
    {
        $item = Item::findOrFail($id);
        return view('temuan.detail', ['title' => 'Detail Temuan', 'item' => $item]);
    }
}
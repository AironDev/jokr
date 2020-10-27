<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::all();
        $faqs = FaqCategory::with('faqs')->orderBy('name')->get();

        return view('faq.index')->with(['faqs' => $faqs, 'categories' => $categories]);

        //return dd($faqs);
    }

    /**
     * Increments the total views
     * @param FAQ    $faq
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementClick(FAQ $faq, $type = 'total_read')
    {
        if ($type == 'total_read' || $type == 'helpful_yes' || $type == 'helpful_no') {
            $faq->increment($type);
        }

        return response()->json(['status' => 'successfulll'], 204);
    }
}
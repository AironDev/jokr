<?php

namespace App\Http\Controllers\Admin\FAQ;

use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class FAQsController extends Controller
{
    /**
     * Display a listing of faq.
     *
     * @return Response
     */
    public function index()
    {
        $faqs = FAQ::with('category')->get();
        $categories = FaqCategory::all();

        //return $items;
        return view('admin.faq.index')->with(['faqs' => $faqs, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new faq.
     *
     * @return Response
     */
    public function create()
    {
        $categories = FaqCategory::all();

        return view('admin.faq.create_edit')->with('categories', $categories);
    }

    /**
     * Store a newly created faq in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, FAQ::$rules);
        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'slug' => Str::slug($request->question),
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('status', 'Created successfully');
    }

    /**
     * Display the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function show(FAQ $faq)
    {
        //return $this->view('faq.show')->with('item', $faq);
        $category = $faq->category;
        return response()->json(['category' => $category, 'faq' => $faq]);
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function edit(FAQ $faq)
    {
        return response()->json($faq);
    }

    /**
     * Update the specified faq in storage.
     *
     * @param FAQ     $faq
     * @param Request $request
     * @return Response
     */
    public function update(FAQ $faq, Request $request)
    {
        //$this->validate($request, FAQ::$rules);

       $faq->update($request->only('question', 'answer', 'category_id'));
        return response()->json($request);
        //return 'dff';
    }

    /**
     * Remove the specified faq from storage.
     *
     * @param FAQ     $faq
     * @param Request $request
     * @return Response
     */
    public function destroy(FAQ $faq)
    {
       
        $faq->delete();
        //return redirect()->back()->with('status', 'FAQ deleted successfully');
        return $faq;
    }
}

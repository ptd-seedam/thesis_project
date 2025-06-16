<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\PublisherService;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    protected PublisherService $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    public function index()
    {
        $publishers = $this->publisherService->getAllPublishers();
        return view('admin.publishers.index', compact('publishers'));
    }

    public function show($id)
    {
        $publisher = $this->publisherService->getPublisherById($id);
        if (!$publisher) {
            abort(404);
        }
        return view('admin.publishers.show', compact('publisher'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'P_NAME' => 'required|string|max:255',
            'P_ADDRESS' => 'nullable|string',
        ]);

        $this->publisherService->createPublisher($data);

        return redirect()->route('admin.publishers.index')->with('success', 'Tạo nhà xuất bản thành công');
    }

    public function edit($id)
    {
        $publisher = $this->publisherService->getPublisherById($id);
        if (!$publisher) {
            abort(404);
        }
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'P_NAME' => 'required|string|max:255',
            'P_ADDRESS' => 'nullable|string',
        ]);

        $this->publisherService->updatePublisher($id, $data);

        return redirect()->route('admin.publishers.index')->with('success', 'Cập nhật nhà xuất bản thành công');
    }

    public function destroy($id)
    {
        $this->publisherService->deletePublisher($id);

        return redirect()->route('admin.publishers.index')->with('success', 'Xóa nhà xuất bản thành công');
    }
}

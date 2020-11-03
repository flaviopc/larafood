<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;
    public function __construct(Tenant $tenant)
    {
        $this->middleware(['can:tenants']);
        $this->repository = $tenant;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', ['tenants' => $tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTenant $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenant $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = $this->repository->with('plan')->find($id);

        if (!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.show', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenant = $this->repository->find($id);

        if (!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.edit', ['tenant' => $tenant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTenant $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {
        $tenant = $this->repository->find($id);

        if (!$tenant)
            return redirect()->back();

        $data = $request->all();


        if ($request->hasFile('logo') && $request->logo->isValid()) {
            if(Storage::exists($tenant->logo))
                Storage::delete($tenant->logo);

            $imgSalva = $request->logo->store("tenants/{$tenant->uuid}/logo");
            $data['logo'] = $imgSalva;
        }

        $tenant->update($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tenant = $this->repository->find($id);
        if(Storage::exists($tenant->image))
                Storage::delete($tenant->image);

        if (!$tenant)
            return redirect()->back();

        return redirect()->route('tenants.index');
    }

    /**
     * Search results
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');
        $tenants = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('description', 'LIKE', "%{$request->filter}%")
                        ->orWhere('title', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate();

        return view('admin.pages.tenants.index', ['tenants' => $tenants, 'filters' => $filters]);
    }
}

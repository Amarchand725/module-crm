<?php

namespace App\Modules\Country\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Country\Repositories\Eloquent\CountryRepository;
use App\Modules\Country\Http\Requests\CountryRequest;
use App\Modules\Country\Models\Country;
use Exception;

class CountryController extends Controller
{
    protected $countryRepo;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        return view(strtolower('countries.index'), compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(CountryRequest $request)
    {
        $payload = $request->validated();
        
        try {
            $this->countryRepo->storeModel($payload);
            return redirect()->route(strtolower('countries.index'))->with('success', 'Country created successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $country = $this->countryRepo->showModel($id);
        return view('countries.edit', compact('country'));
    }

    public function update(CountryRequest $request, Country $country)
    {
        $payload = $request->validated();

        try {
            $this->countryRepo->updateModel($country, $payload);
            return redirect()->route(strtolower('countries.index'))->with('success', 'Country updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $country = $this->countryRepo->showModel($id);
        return view('countries.show', compact('country'));
    }

    public function destroy($id)
    {
        try {
            $this->countryRepo->softDeleteModel($id);
            return redirect()->route(strtolower('Country.index'))->with('success', 'Country deleted successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function restore($id)
    {
        try {
            $this->countryRepo->restoreModel($id);
            return redirect()->route(strtolower('Country.index'))->with('success', 'Country restored successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function forceDelete($id)
    {
        try {
            $this->countryRepo->permanentlyDeleteModel($id);
            return redirect()->route(strtolower('Country.index'))->with('success', 'Country permanently deleted.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function bulkDelete()
    {
        try {
            $this->countryRepo->bulkDelete();
            return redirect()->route(strtolower('Country.index'))->with('success', 'Bulk delete successful.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function bulkRestore()
    {
        try {
            $this->countryRepo->bulkRestore();
            return redirect()->route(strtolower('Country.index'))->with('success', 'Bulk restore successful.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
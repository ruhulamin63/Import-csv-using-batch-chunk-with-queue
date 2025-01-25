<?php

namespace App\Http\Controllers;

use App\Jobs\batchCSVData;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\View\View;

class StudentImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|mimes:csv',
        ]);
        
        if ($request->has('csv')) {
            $csv = file($request->csv);

            $chunks = array_chunk($csv, 1000);

            $header = [];

            $batch = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {

                $data = array_map('str_getcsv', $chunk);

                if ($key == 0) {

                    $header = $data[0];

                    unset($data[0]);

                }
                $batch->add(new batchCSVData($data, $header));
            }
            return redirect()->route('students.index')
                ->with('success', 'CSV Import added on queue. will update you once done.');

            // return redirect()->route('sent.mail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

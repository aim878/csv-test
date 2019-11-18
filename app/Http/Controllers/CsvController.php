<?php

namespace App\Http\Controllers;

use App\Csv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CsvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->importCsv();
        return View::make('csv')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = public_path('file/transactions.csv');

        $row = [];
        $data = $request->all();
        foreach ($data as $value) {
            array_push($row, $value);
        }

        $this->addRecordToCsv($file, $row);
        return response()->json(['data' => $row], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Csv  $csv
     * @return \Illuminate\Http\Response
     */
    public function show(Csv $csv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Csv  $csv
     * @return \Illuminate\Http\Response
     */
    public function edit(Csv $csv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Csv  $csv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Csv $csv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Csv  $csv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Csv $csv)
    {
        //
    }


    // __ __ Helper Functinos __ __ //
    // __ __ __ __ __ __ __ __ __ _ //

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public function importCsv()
    {
        $file = public_path('file/transactions.csv');
        $customerArr = $this->csvToArray($file);
        return $customerArr;   
    }

    public function addRecordToCsv($filename = '', $item = '')
    {
        $fp = fopen($filename, 'a');  //Open file for append
        fputcsv($fp, $item); //@Optimist
        fclose($fp);
    }
}

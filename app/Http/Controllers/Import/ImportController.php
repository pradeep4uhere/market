<?php

namespace App\Http\Controllers\Import;
use App\Product;
use App\Http\Controllers\Master;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Master
{

    public function getImport()
    {
        return view(Master::loadFrontTheme('import.import'));
    }

    public function parseImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 1000);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view(Master::loadFrontTheme('import.import_fields'), compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        $count =0;
        foreach ($csv_data as $row) {
            $Product = new Product();
            foreach (config('import.products') as $field) {
                if ($data->csv_header) {
                    $Product->$field = $row[$request->fields[$field]];
                } else {
                    $Product->$field = $row[$request->fields[$index]];
                }
            }
            $Product->save();
            $count++;
        }

        return view(Master::loadFrontTheme('import.import_success'),array('count'=>$count));
    }

}

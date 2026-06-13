<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use OpenSpout\Reader\Common\Creator\ReaderEntityFactory;

class ImportController extends Controller
{
    public function fileImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,ods',
        ]);

        $reader = ReaderEntityFactory::createReaderFromFile($request->file('file')->getRealPath());
        $reader->open($request->file('file')->getRealPath());

        $headers = [];
        $import = new UsersImport();
        $imported = 0;

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $values = $row->toArray();

                if ($headers === []) {
                    $headers = collect($values)
                        ->map(fn ($value) => Str::slug((string) $value, '_'))
                        ->all();

                    continue;
                }

                $data = [];
                foreach ($headers as $index => $header) {
                    if ($header !== '') {
                        $data[$header] = $values[$index] ?? null;
                    }
                }

                $user = $import->model($data);
                if ($user !== null) {
                    $user->save();
                    $imported++;
                }
            }

            break;
        }

        $reader->close();

        return redirect()->back()->with('success', $imported . ' leads successfully imported!');
    }

    public function downloadDoc()
    {
        $download_path = (public_path() .  '/storage/' . 'leads.xlsx');
        return (Response::download($download_path));
    }
}

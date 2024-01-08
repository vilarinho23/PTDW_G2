<?php

namespace App\Http\Controllers;

use App\Exports\RestricoesExport;
use App\Imports\DSDImport;
use App\Models\Docente;
use App\Models\KeyValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    private function getComissaoName()
    {
        $user = auth()->user();
        if (!$user) return "unknown";

        $name = $user->name ?? "unknown name";
        $email = $user->email ?? "unknown email";
        return "$name ($email)";
    }

    private function getCurrentTimestamp()
    {
        return Carbon::now()->format('d/m/Y H:i:s');
    }


    public function import(Request $request)
    {
        // Check if file is valid
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Get file, filename and uploader
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $uploader = $this->getComissaoName();

        // Import file
        $import = new DSDImport;
        Excel::import($import, $file);
        $timestamp = $this->getCurrentTimestamp();

        // Set last import filename, uploader and timestamp
        KeyValue::set('last_import:filename', $filename);
        KeyValue::set('last_import:uploader', $uploader);
        KeyValue::set('last_import:timestamp', $timestamp);

        // Set last import errors (line numbers)
        $errors = $import->getErrors();
        $errorLines = array_keys($errors);
        $errorLines = $errorLines == [] ? null : implode(',', $errorLines);
        KeyValue::set('last_import:line_errors', $errorLines);

        // Return response
        return response()->json([
            'message' => "Importação do ficheiro $filename concluída",
            'filename' => $filename,
            'uploader' => $uploader,
            'timestamp' => $timestamp,
            'errors' => $errors
        ]);
    }

    public function export()
    {
        // Get filename and downloader
        $filename = 'Output_restricoes.xlsx';
        $downloader = $this->getComissaoName();

        // Export file
        $export = new RestricoesExport;
        $download = Excel::download($export, $filename);
        $timestamp = $this->getCurrentTimestamp();

        // Set last export downloader and timestamp
        KeyValue::set('last_export:dowloader', $downloader);
        KeyValue::set('last_export:timestamp', $timestamp);

        return $download;
    }

    public function exportDocente(Docente $docente)
    {
        // Get filename and downloader
        $filename = "Output_restricoes_docente{$docente->num_func}.xlsx";
        $downloader = $this->getComissaoName();

        // Prepare collection (only one docente)
        $docente->load('restricoes', 'respUnidadesCurriculares', 'unidadesCurriculares');
        $collection = collect([$docente]);

        // Export file
        $export = new RestricoesExport($collection);
        $download = Excel::download($export, $filename);
        $timestamp = $this->getCurrentTimestamp();

        // Set last export downloader and timestamp
        KeyValue::set('last_export:dowloader', $downloader);
        KeyValue::set('last_export:timestamp', $timestamp);

        return $download;
    }
}

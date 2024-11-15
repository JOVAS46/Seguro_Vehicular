<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Backup\BackupJob;

class BackupController extends Controller
{
    public function runBackup()
    {
        $command = 'php ' . base_path('artisan') . ' backup:run';
        $output = shell_exec($command);
        
        return response()->json([
            'output' => $output
        ]);
    }
    
}

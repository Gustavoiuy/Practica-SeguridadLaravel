<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SecurityCheck extends Command
{
    protected $signature = 'security:check';
    protected $description = 'Check for security vulnerabilities';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $criticalPaths = [
            storage_path('app'),
            storage_path('framework'),
            storage_path('logs'),
          
            
        ];
    
        $vulnerablePaths = [];
    
        foreach ($criticalPaths as $path) {
            if (!is_writable($path)) {
                $vulnerablePaths[] = $path;
            }
        }
    
        if (count($vulnerablePaths) > 0) {
            $this->error('Vulnerabilidad de seguridad encontrada: permisos de archivos inadecuados en las siguientes rutas:');
            foreach ($vulnerablePaths as $path) {
                $this->error('- ' . $path);
            }
        } else {
            $this->info('No se encontraron vulnerabilidades de seguridad en los permisos de archivos.');
        }
    }
}

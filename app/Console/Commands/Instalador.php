<?php

namespace App\Console\Commands;

use App\Models\Backend\Rol;
use App\Models\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Instalador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando se ejecuta el instalador inicial del proyecto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!$this->verificar()){
            //$this->info('EL comando se ejecut exitosamente');
            $usuario = $this->crearUsuarioSuperAdmin();
            $rol = $this->crearRolSuperAdmin();
            $usuario->rol()->attach($rol);
            $this->line('El Rol y Usuario Administrador se instalaron correctamente');
            //Relacionarlo
        }
        else{
            $this->error('No se puede ejecutar el instalador, porque ya hay un rol creado');
        }
    }

    private function verificar(){
        return Rol::find(1);
    }

    private function crearRolSuperAdmin(){
        $rol = 'Super Administrador';
        return Rol::create([
            'nombre' => $rol,
            'slug' => Str::slug($rol, '-')
        ]);
    }

    private function crearUsuarioSuperAdmin(){
        return Usuario::create([
            'nombre' => 'blog_admin',
            'email' => 'blog@gmail.com',
            'password' => Hash::make('pass1234'),
            'estado' => 1
        ]);
    }
}

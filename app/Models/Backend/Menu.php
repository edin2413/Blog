<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rol()
    {
        return $this->belongsToMany(Rol::class, 'menu_rol', 'menu_id', 'rol_id');
    }

    private function getMenuPadres($front)
    {
        if ($front) {
            return $this->whereHas('rol', function ($query)
            {
               $query->where('rol_id', session('rol_id'))->orderby('menu_id');
            })->orderby('menu_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('menu_id')
                    ->orderby('orden')
                    ->get()
                    ->toArray();
        }
    }

    public function getMenuHijos($padres, $line)
    {
        $hijos = [];
        foreach ($padres as $line2) {
            if ($line['id'] == $line2['menu_id']) {
                $hijos = array_merge($hijos, [array_merge($line2, ['submenu' => $this->getHijos($padres, $line)])]);
            }
        }
        return $hijos;
    }

    public static function getMenu($front = false)
    {
        $menu = new Menu();
        $padres = $menu->getMenuPadres($front);
        $menuAll = [];
        foreach ($padres as $line){
            if ($line['menu_id'] != null)
                break;
                $item = [array_merge($line, ['submenu' => $menu->getMenuHijos($padres, $line)])];
                $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }
}

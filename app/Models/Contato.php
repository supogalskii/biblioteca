<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;
    
    public function emprestimos(){
        return $this->hasMany(Emprestimo::class, 'livros_id', 'id');
    }
}

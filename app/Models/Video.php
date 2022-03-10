<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\VideosGenere;

class Video extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'videos';

    protected $fillable = [
        'id',
        'title',
        'creationDate',
        'sinopsis',
        'duration',
        'file',
        'tipo',
        'episode',
        'season',
        'imageFilm',
    ];

    public function generes()
    {
        return $this->hasMany(Genere::class);
    }

    // Exemple per agafar tipus de pelicules
    function scopeByTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }
    function scopeByOrderBy($query)
    {
        return $query->orderBy('title', 'asc');
    }
    function scopeByGenere($query, $genere)
    {
        return $query
            ->where('generes.idGenere', '=', $genere);
    }
    function scopeJoinGenere($query)
    {
        return $query
            ->join('videos_generes', 'id', '=', 'idVideoVG')
            ->join('generes', 'idGenereVG', '=', 'idGenere')
            ->select('videos.*', 'generes.genere');
    }

    function scopeByMovie($query, $title)
    {
        return $query->where('title', $title);
    }

    function scopeById($query, $id) {
        return $query->where('id', $id);
    }

    function scopeByTitle($query, $title) {
        return $query->where('title', 'like' ,'%'. $title .'%');
    }
}

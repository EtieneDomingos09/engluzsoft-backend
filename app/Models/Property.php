<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'tipo_imovel',
        'tipo_transacao',
        'titulo',
        'descricao',
        'quartos',
        'banheiros',
        'area_util',
        'area_total',
        'endereco',
        'provincia',
        'municipio',
        'preco',
        'telefone_contato',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'property_feature');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function views()
    {
        return $this->hasMany(PropertyView::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}


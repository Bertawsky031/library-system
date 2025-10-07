<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    // ✅ Pastikan tanggal otomatis dikonversi ke objek Carbon
    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    // ✅ Accessor: supaya aman tampilkan tanggal terformat atau '-'
    public function getBorrowDateFormattedAttribute()
    {
        return $this->borrow_date ? $this->borrow_date->format('d M Y') : '-';
    }

    public function getReturnDateFormattedAttribute()
    {
        return $this->return_date ? $this->return_date->format('d M Y') : '-';
    }

    // ✅ Relasi
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     
}

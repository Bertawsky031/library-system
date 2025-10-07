<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
        $borrowings = Borrowing::with('book', 'user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                $q->whereBetween('borrowed_at', [$request->from_date, $request->to_date]);
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());

            return view('admin.borrowings.index', compact('borrowings'));
        } else {
            $borrowings = Borrowing::with('book')
                ->where('user_id', $user->id)
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                    $q->whereBetween('borrowed_at', [$request->from_date, $request->to_date]);
                })
                ->latest()
                ->paginate(10)
                ->appends($request->query());

            $books = Book::all();

            return view('user.borrowings.index', compact('books', 'borrowings'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia!');
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve($id)
    {
        $borrow = Borrowing::findOrFail($id);
        $book = $borrow->book;

        if ($borrow->status === 'pending') {
            $borrow->update(['status' => 'approved']);
            $book->decrement('stock');
        }

        return back()->with('success', 'Peminjaman disetujui!');
    }

    // Admin reject peminjaman
    public function reject($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->status === 'pending') {
            $borrow->update(['status' => 'rejected']);
        }

        return back()->with('success', 'Peminjaman ditolak!');
    }

    // Admin menandai pengembalian
    public function markReturned($id)
    {
        $borrow = Borrowing::findOrFail($id);
        $book = $borrow->book;

        if ($borrow->status === 'approved') {
            $borrow->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);

            $book->increment('stock');
        }

        return back()->with('success', 'Buku telah dikembalikan!');
    }

    public function history(Request $request)
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                $q->whereBetween('borrowed_at', [$request->from_date, $request->to_date]);
            })
            ->latest()
            ->paginate(5)
            ->appends($request->query());

        return view('user.borrowings.history', compact('borrowings'));
    }

}

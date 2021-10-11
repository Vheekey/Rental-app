<div class="table-responsive">

    <table class="table table-bordered text-center">
        <thead>
            <th> Name </th>
            <th> Code </th>
            <th> Status </th>
        </thead>

        <tbody>
            @if (count($books) < 1)
                <tr> No books Found  </tr>
            @else
                @foreach ($books as $book)
                <tr>
                    <td> {{ $book->name }} </td>
                    <td> {{ $book->code }} </td>
                    <td> {{ $book->availability() }} </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="">
        @if($books instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $books->links('pagination::bootstrap-4') }}
        @endif
    </div>

</div>

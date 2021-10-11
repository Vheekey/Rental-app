<div class="table-responsive">

    <table class="table table-bordered text-center">
        <thead>
            <th> Name </th>
            <th> Code </th>
            <th> Status </th>
        </thead>

        <tbody>
            @if (count($equipments) < 1)
                <tr> No equipments Found  </tr>
            @else
                @foreach ($equipments as $equipment)
                <tr>
                    <td> {{ $equipment->name }} </td>
                    <td> {{ $equipment->code }} </td>
                    <td> {{ $equipment->availability() }} </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="">
        @if($equipments instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $equipments->links('pagination::bootstrap-4') }}
        @endif
    </div>

</div>

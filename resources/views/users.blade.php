@include('layout.header')
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="">

                <div class="font-weight-bold h3">Users</div>

                <div class="table-responsive">

                    <table class="table table-bordered text-center">
                        <thead>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Action </th>
                        </thead>

                        <tbody>
                            @if (count($users) < 1)
                                <tr> No Users Found  </tr>
                            @else
                                @foreach ($users as $user)
                                <tr>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> <a href="{{ route('users-details', $user->id) }}"> <i class="fa-solid fa-eye"> </i></a>  </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="">
                        @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $users->links('pagination::bootstrap-4') }}
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </div>


@include('layout.footer')

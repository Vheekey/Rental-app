@include('layout.header')
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="p-3">

                <div class="panel panel-default">

                    <div class="panel-heading fw-bolder mt-3 mb-4">Basic Details</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-1 fw-bolder"> Name: </div>
                            <div class="col-md-5 mb-4"> {{ $user->name }} </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1 fw-bolder"> Email: </div>
                            <div class="col-md-6 mb-4"> {{ $user->email }} </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-title mt-2 p-4 fw-bolder text-center"> Summary of Activities </div>
                        <div class="card-body table-responsive">
                            @if (count($user->activity) < 1)
                                <div class="text-danger fw-bolder text-center"> No Activities </div>
                            @else
                            <table class="table table-striped">
                                <thead>
                                    <th>Item</th>
                                    <th>Item Code</th>
                                    <th>Status</th>
                                    <th>Date Rented</th>
                                    <th>Date Returned</th>
                                </thead>
                                @foreach ($user->activity as $activity)
                                    <tr>
                                        <td>{{ $activity->itemable->name }}</td>
                                        <td>{{ $activity->itemable->code }}</td>
                                        <td>
                                            @if (! $activity->status)
                                                Returned
                                            @else
                                                Rented
                                            @endif
                                        </td>
                                        <td>{{ $activity->created_at }}</td>
                                        <td>
                                            @if ($activity->status)
                                            Not Returned
                                            @else
                                                {{ $activity->updated_at }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


@include('layout.footer')

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('items') }}" method="GET">
            <div class="row mt-4">
                <div class="col-md-2">
                    <label for="" class="fw-bolder">Search</label>
                </div>
                <div class="col-md-4">
                    <select name="search" id="" class="form-control" required>
                        <option value="">--</option>
                        <option value="books">Books</option>
                        <option value="equipment">Equipments</option>
                    </select>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-2">
                    <label for="" class="fw-bolder">For</label>
                </div>
                <div class="col-md-4">
                    <select name="parameter" id="" class="form-control" required>
                        <option value="">--</option>
                        <option value="name">Name</option>
                        <option value="code">Code</option>
                    </select>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-2">
                    <label for="" class="fw-bolder">Value</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="value" required>
                </div>
            </div>
            <input type="submit" value="Search" class="btn btn-md btn-dark mt-3">
        </form>
    </div>

    <div class="vr"></div>
    <div class="col-md-5 mt-3 fw-bold">
        @if ($result && count(array($result)) > 0)
            Name: {{ $result->name }}
            <p></p>
            Code: {{ $result->code }}
            <p></p>
            Status: {{ ($result->status) ? 'AVAILABLE' : 'UNAVAILABLE' }}
        @else
            No Searches
        @endif
    </div>
</div>


@include('layout.header')
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="">

                <div class="font-weight-bold h3">Items</div>

                <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="search-tab" data-bs-toggle="tab" data-bs-target="#search" type="button" role="tab" aria-controls="search" aria-selected="true">Search</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="books-tab" data-bs-toggle="tab" data-bs-target="#books" type="button" role="tab" aria-controls="books" aria-selected="false">Books</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="equipments-tab" data-bs-toggle="tab" data-bs-target="#equipments" type="button" role="tab" aria-controls="equipments" aria-selected="false">Equipments</button>
                    </li>
                  </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div id="search" class="tab-pane fade show active" role="tabpanel" aria-labelledby="search-tab">
                    @include('partials.items-search')
                </div>

                <div id="books" class="tab-pane fade" id="books" role="tabpanel" aria-labelledby="books-tab">
                    @include('partials.books')
                </div>

                <div id="equipments" class="tab-pane fade" id="equipments" role="tabpanel" aria-labelledby="equipments-tab">
                    @include('partials.equipments')
                </div>
            </div>

        </div>

    </div>




@include('layout.footer')

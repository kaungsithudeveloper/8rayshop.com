@extends('backend.admin.layout.layout')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All State</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">State</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <form id="myForm" method="post" action="{{ route('update.state') }}"   >
                                @csrf

                                <input type="hidden" name="id" value="{{ $state->id }}">
                                <div class="card-header">
                                    <h4 class="card-title">Create State</h4>
                                </div>


                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Division Name :</label>
                                        <select name="division_id" class="form-control form-select" data-bs-placeholder="Select Division">
                                            <option selected="">Open this select menu</option>
                                            @foreach($division as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $state->division_id ? 'selected' : ''  }}>
                                                {{ $item->division_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">District Name :</label>
                                        <select name="district_id" class="form-control form-select" data-bs-placeholder="Select">
                                            <option selected="">Open this select menu</option>

                                            @foreach($district as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $state->district_id ? 'selected' : ''  }}>
                                                {{ $item->district_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">State Name :</label>
                                        <input type="text" class="form-control" name="state_name" value="{{ $state->state_name }}">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Create State</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="responsive-datatable"
                                        class="table table-bordered text-nowrap mb-0 table-striped">
                                        <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent border-bottom-0 text-center" style="width: 3%;">ID
                                                </th>
                                                <th class="bg-transparent border-bottom-0"> Division Name </th>
                                                <th class="bg-transparent border-bottom-0"> District Name </th>
                                                <th class="bg-transparent border-bottom-0"> State Name </th>
                                                <th class="bg-transparent border-bottom-0 text-center " style="width: 10%;">
                                                    Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($states as $key => $item)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold"> {{ $key + 1 }} </h6>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $item['division']['division_name'] }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $item['district']['district_name'] }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $item->state_name }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="g-2 text-center">

                                                                <a href="{{ route('edit.state',$item->id) }}"
                                                                    class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Edit">
                                                                    <span class="fe fe-edit fs-14"></span>
                                                                </a>

                                                                <a href="{{ route('delete.state',$item->id) }}"
                                                                    class="btn text-danger btn-sm" id="delete"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Delete">
                                                                    <span class="fe fe-trash-2 fs-14"></span>
                                                                </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
<!--app-content close-->

<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/district/ajax') }}/"+division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var districtSelect = $('select[name="district_id"]');
                        districtSelect.empty();
                        districtSelect.append('<option selected disabled>Select District</option>');
                        $.each(data, function(key, value){
                            districtSelect.append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('Please select a division first.');
            }
        });
    });
</script>

@endsection


@push('scripts')
    <!-- Include the JavaScript files needed for the create page -->
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/js/table-data.js') }}"></script>
@endpush

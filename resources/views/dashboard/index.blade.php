@extends('layouts.default')

@section('title', 'Dashboard')

@section('custom_css')
    <!-- Custom styles for this page -->
    <link href="{{ url('/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop

@section('custom_script')
    <!-- Page level plugins -->
    <script src="{{ url('/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@stop

@section('content')

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>National ID</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Mobile Phone</th>
                                            <th>Graduate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($candidates as $candidate)
                                        <tr>
                                            <td>{{ $candidate->id_number }}</td>
                                            <td>{{ $candidate->fullname }}</td>
                                            <td>{{ $candidate->additionalInformation->position }}</td>
                                            <td>{{ $candidate->mobile_phone }}</td>
                                            <td>{{ ($candidate->freshgraduate == "0" ? "Fresh" : "Experienced") }}</td>
                                            <td>
                                                <a href="{{ route('generateCV-adidata', $candidate->id) }}" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-file-pdf"></i> Adidata
                                                </a>
                                                <a href="{{ route('generateCV-bi', $candidate->id) }}" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-file-pdf"></i> BI
                                                </a>
                                                <a href="{{ route('generateDocCV-adidata', $candidate->id) }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-file-word"></i> Adidata
                                                </a>
                                                <a href="{{ route('generateDocCV-bi', $candidate->id) }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-file-word"></i> BI
                                                </a>
                                                <a href="{{ route('ziparchive', $candidate->id) }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-file-archive"></i> Docs
                                                </a>
                                                <a href="{{ route('detail', $candidate->id) }}" class="btn btn-success" target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-eye"></i> Show
                                                </a>
                                            </td>
                                        </tr> 
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                
@stop
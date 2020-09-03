@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of contacts</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead id="table" class="table table-bordered table-hover thead-inverse">
                            <tr>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

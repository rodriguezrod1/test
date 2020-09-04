@extends('layouts.app')
@section('title', 'Home')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
     <!-- MDBootstrap Datatables  -->
     <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<style>.editable{cursor: pointer;}</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">List of contacts</div>
                        <div class="col-md-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-agregar-user">
                                Add New
                            </button>
                        </div>
                    </div>                    
                </div>
                <div class="card-body table-responsive">
                    <table id="table_users" class="table table-striped table-inverse table-bordered table-hover">                                                
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="modal-agregar-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg ">
        <form id="form-agregar-user"  autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"  required autocomplete="name" autofocus>                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="last_name"  required autocomplete="last_name" >                    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">Contact Number</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="contact_number"  required  >                          
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  required autocomplete="email">                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect text-left btn-lg">
                        <i class="fa fa-save"></i>
                        <span id="text">Add</span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection
@section('script')
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <!-- Sweet-Alert  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.min.js"></script>
    <script src="{{ asset('js/node_modules/toast-master/js/jquery.toast.js') }}"></script>
    <!--Custom  -->
    <script src="{{ asset('js/tests.js') }}"></script>
    <script src="{{ asset('js/users.js') }}"></script>
@endsection

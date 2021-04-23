@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fa fa-globe"></i>
                                AdminLTE, Inc.
                            <small class="float-right">
                                Date: 2/10/2018
                            </small>
                        </h4>
                    </div>
                    <!-- / .col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        from
                        <address>
                            <strong>John Doe</strong><br>
                            795 Folson Ave, Suite 600 <br>
                            San Fransisco, CA 94187 <br>
                            Phone: (555) 539-1037 <br>
                            Email: john.doe@example.com
                        </address>
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-12">
                        <a href="" @click.prevent="printme" target="_blank" class="btn btn-default">
                        <i class="fa fa-print"></i>
                            Print
                        </a>
                        <button type="button" class="btn btn-success float-right">
                        <i class="fa fa-credit-card"></i>
                            Submit Payment
                        </button>

                        <button type="button" class="btn btn-primary float-right"
                        style="margin-right: 5px;">
                            <i class="fa fa-download"></i>
                                Generate PDF
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

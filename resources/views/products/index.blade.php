@extends('layouts.app')


@section('content')
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<!-- Bootstrap JavaScript -->


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row" style="margin: 5px 0;">
                            <div class="col-lg-8 text-muted">
                                <div class="col-lg-4">
                                    <h3>FILTERS</h3>
                                </div>
                            </div>
                            
                        </div>
                       
                            <div class="row col-md-12"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name </label>
                                        {{Form::text('name', null, array('placeholder'=>'Name','id'=>'name','class'=>'form-control', 'autocomplete' => 'off'))}}
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Detail </label>
                                        {{Form::text('detail', null, array('placeholder'=>'Detail','id'=>'detail','class'=>'form-control', 'autocomplete' => 'off'))}}
                                    </div>
                                </div> 
                                
                            </div> 
                            

                    </div>

                    <div class="card-body">
                        <h4 class="card-title">
                       
                        </h4>
         
                        <hr> 
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm" id="products-table">
                                <thead>
                                    <th>S.No</th>    
                                    <th>Name</th>    
                                    <th>Detail</th>    
                                    <th>Created At</th>    
                                    <th>Updated At</th>    
                                    <th width="100">Action</th>    
                                </thead> 
                            </table>  
                        </div>  
                    </div>
                </div>
            </div>
        </div>



    <?php /* ?>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
    <?php */ ?>


    <?php /* ?>
    {!! $products->links() !!}
    <?php */?>

<script>
     var oTable =$('#products-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true, 
         ajax:{
            url : '{!! route('data.datatables') !!}',
            data: function (d) {
                
                // d.role = $('#role').val(); 
                // d.status = $('#status').val(); 
                d.name = $('#name').val(); 
                d.detail = $('#detail').val(); 
                d.search = $('input[type="search"]').val();
            }
        },
    
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'detail', name: 'detail'},
            {data: 'created_at', name: 'created_at'}, 
            {data: 'updated_at', name: 'updated_at'}, 
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order:[[0,'desc']],
        searching:false,
        // bLengthChange:false,
    });
    $('#role').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#status').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#name').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#detail').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

<!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
      
<p class="text-center text-primary"><small><?php echo date('Y'); ?></small></p>
@endsection
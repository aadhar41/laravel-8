@can('product-edit')
<a href="{{route('product.edit', $id)}}" class='btn btn-xs btn-info btn-sm'><i class='fas fa-eye'></i> Edit</a> 
@endcan
@can('product-delete')
<a href="{{route('product.delete', $id)}}" class='btn btn-xs btn-danger btn-sm'><i class='fas fa-eye'></i> Delete</a> 
@endcan
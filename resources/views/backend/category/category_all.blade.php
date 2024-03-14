@extends('admin.admin_dashboard')
@section('admin')

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Category all</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('add.category')}}" class="btn btn-primary">Add New</a>
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Category Data</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SI No.</th>
										<th>Category Name</th>
										<th>Category Slug</th>
										<th>Category Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($categories as $index => $item)
									<tr>
										<td>{{ $index +1 }}</td>
										<td>{{$item->category_name}}</td>
										<td>{{$item->category_slug}}</td>
										<td><img src="{{url('/').$item->category_image }}"width="60
											" height="50"/></td>
										<td><a href="{{route('edit.category',$item->id)}}" 
											class="btn btn-success">Edit</a> 
											<a href="{{route('delete.category',$item->id)}}" 
											class="btn btn-danger" id="delete">Delete</a></td>
									</tr>
								@endforeach

									
								</tbody>
								<tfoot>
									<tr>
										<th>SI No.</th>
										<th>Category Name</th>
										<th>Category Slug</th>
										<th>Category Image</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

@endsection
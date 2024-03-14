@extends('admin.admin_dashboard')
@section('admin')

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Brand</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Brand all</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('add.brand')}}" class="btn btn-primary">Add New</a>
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Brand Data</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SI No.</th>
										<th>Brand Name</th>
										<th>Brand Slug</th>
										<th>Brand Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($brands as $index => $item)
									<tr>
										<td>{{ $index +1 }}</td>
										<td>{{$item->brand_name}}</td>
										<td>{{$item->brand_slug}}</td>
										<td><img src="{{asset('/').$item->brand_image }}"width="60
											" height="50"/></td>
										<td><a href="{{route('edit.brand',$item->id)}}" 
											class="btn btn-success">Edit</a> 
											<a href="{{route('delete.brand',$item->id)}}" 
											class="btn btn-danger" id="delete">Delete</a></td>
									</tr>
								@endforeach

									
								</tbody>
								<tfoot>
									<tr>
										<th>SI No.</th>
										<th>Brand Name</th>
										<th>Brand Slug</th>
										<th>Brand Image</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

@endsection
@extends('admin.admin_dashboard');
@section('admin')
					
					  <div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Inactive Vendors</h5>
								</div>
								<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
								</div>
							</div>
							<hr>
							<div class="table-responsive">
								<table class="table align-middle mb-0">
									<thead class="table-light">
										<tr>
											<th>SL</th>
											<th>Name</th>
											<th>User Name</th>
											<th>Email</th>
											<th>Join Date</th>
											<th>Photo</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($vendorData as $index => $item)
										<tr>
										<td>{{$index+1}}<td>
										<td>{{$item->name}}<td>
										<td>{{$item->username}}<td>
										<td>{{$item->email}}<td>
										<td>{{$item->vendor_join}}<td>
										<td><img src="{{(!empty($item->photo))?url('upload/user_images/'.$item->photo):url('upload/no_image.jpg')}}" width="50" /><td>
											<td>{{$item->status}}<td>
										<td>
											<div class="d-flex order-actions">
												<form action="{{route('active.id',$item->id)}}" method="post">
												@csrf
												<button type="submit" class="btn">Active</button>
												<form>
											</div>
										</td>
												<tr>
										@endforeach
										<tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
@endsection
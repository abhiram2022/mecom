@extends('vendor.vendor_dashboard')
@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Vendor Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Vendor |  Profile</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="{{(!empty($vendorData->photo))? url('upload/vendor_images/'.$vendorData->photo):url('upload/no_image.jpg')}}" alt="Vendor" class="rounded-circle p-1 bg-primary" width="110" height="100">
											<div class="mt-3">
												<h4>{{$vendorData->username}}</h4>
												<p class="text-secondary mb-1">{{$vendorData->email}}</p>
											</div>
										</div>
										<hr class="my-4" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
												<span class="text-secondary">https://codervent.com</span>
											</li>
											
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
												<span class="text-secondary">codervent</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<form method="POST" enctype="multipart/form-data"
										action="{{route('vendor.profile.store')}}">
										@csrf
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0"> Vendor User Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$vendorData->username}}" name="username" disabled/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Vendor Full Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$vendorData->name}}" name="name"/>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0"> Vendor Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$vendorData->email}}" name="email"/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Phone</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$vendorData->phone}}" name="phone" />
											</div>
										</div>
										
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Vendor Join</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="date" class="form-control" value="{{$vendorData->vendor_join}}" name="vendor_join"/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Vendor Short Info</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<textarea type="text" class="form-control" value="" name="vendor_short_info">{{$vendorData->vendor_short_info}}</textarea>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Photo</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="file" class="form-control" 
												id="image" name="photo"/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0"></h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<img id="showImage" src="{{(!empty($vendorData->photo))? url('upload/vendor_images/'.$vendorData->photo):url('upload/no_image.jpg')}}" alt="Admin"  width="110" height="100">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" name="submit" class="btn btn-primary px-4" value="Save Changes" />
											</div>
										</div>
										</form>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
<script type="text/javascript">
$(document).ready(function () {
    $('#image').change(function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showImage').attr('src', e.target.result); 
        };
        reader.readAsDataURL(e.target.files[0]);
    });
});

</script>				

@endsection
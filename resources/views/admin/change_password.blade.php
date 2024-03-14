@extends('admin.admin_dashboard')
@section('admin')
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Admin Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Admin |  Change Password</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<form method="POST" 
										action="{{route('admin.update.password')}}">
										@csrf
										@if(session('status'))
										<div class="alert alert-success" >{{session('status')}}</div>
										@elseif(session('error'))
										<div class="alert alert-danger" >{{session('error')}}</div>
										@endif
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Old Password</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="password"
												 class="form-control @error('old_password') is-invalid @enderror" value="" name="old_password" id="old_password"/>
											</div>
											@error('old_password')
											<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">New Password</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input  type="password"
												 class="form-control @error('new_password') is-invalid @enderror" value="" name="new_password" id="new_password"/>
											</div>
											@error('new_password')
											<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Confirm Password</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="password"
												 class="form-control @error('confirm_password') is-invalid @enderror" value="" name="confirm_password" id="confirm_password"/>
											</div>
											@error('confirm_password')
											<span class="text-danger">{{$message}}</span>
											@enderror
										</div>


										
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" name="submit" class="btn btn-primary px-4" value="Change Password" />
											</div>
										</div>
										</form>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				

@endsection
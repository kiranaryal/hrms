@extends('portal_pages.layouts.master')
@section('content')

	<div class="page-wrapper">
		<div class="container-fluid">

            <div class="row">
            <div class="col-lg-12">
                <x-message />
            </div>
            </div>

			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Update Employee User</h4>

				<form method="post" id="brandForm" name="brandForm" action="/update/employee" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
                       <input type="hidden" name="id" value="{{ $data->id}}">
						<input type="hidden" name="user_id" value="{{$user_id}}">

                        <div class="row mb-3">
							<div class="col">
								<input type="text" name="fname" value="{{ $data->fname}}" placeholder="First Name" class="form-control" >
							</div>
                            <div class="col">
								<input type="text" name="lname" value="{{ $data->lname}}" placeholder="Last Name" class="form-control" >
							</div>
						</div>

                        <div class="row mb-3">
							<div class="col">
								<input type="text" name="son_of" value="{{ $data->son_of}}" placeholder="Father's Name" class="form-control" >
							</div>
                            <div class="col">
								<input type="email" name="persnol_email" value="{{ $data->persnol_email}}" placeholder="Personal Email" class="form-control" >
							</div>
						</div>

                        <div class="row mb-3">
							<div class="col">
								<input type="tel" name="age"  value="{{ $data->age}}" placeholder="Age" class="form-control" >
							</div>
                            <div class="col">
								<input type="date" name="dob"  value="{{ $data->dob}}" placeholder="Date of Birth" class="form-control" >
							</div>
						</div>

                        <div class="row mb-3">
							<div class="col">
								<input type="text" name="gender"  value="{{ $data->gender}}" placeholder="Gender" class="form-control" >
							</div>
                            <div class="col">
								<input type="text" name="city"  value="{{ $data->city}}" placeholder="City" class="form-control" >
							</div>
						</div>

                        <div class="row mb-3">
							<div class="col">
								<input type="text" name="address"  value="{{ $data->address}}" placeholder="Address" class="form-control" >
							</div>
                            <div class="col">
								<input type="tel" name="persnol_number"  value="{{ $data->persnol_number}}" placeholder="Personal Number" class="form-control" >
							</div>
						</div>

                        <div class="row mb-3">
							<div class="col">
								<input type="text" name="marital_status" value="{{ $data->marital_status}}" placeholder="Marital Status" class="form-control" >
							</div>
                             <div class="col">
								<input type="file" name="empImage[]" placeholder="Employee Image" class="form-control" >
                                @if(!empty($data->image))
                                <a href=" {{ url('uploads/employee_images/'.$data->image) }}" target="_blank">you have already image. View Image
                                 <input type="hidden" name="empImageCheck" value="{{ $data->image}}">
                                </a>
                                @endif
							</div>
						</div>

                        <div class="row mb-3">

                            <div class="col">
                                <input type="tel" name="salary" value="{{ $data->salary}}" placeholder="Salary" class="form-control" >
							</div>
                            <div class="col">
								<select name="empType" id="" class="form-control">
                                    @foreach ($etypes as $etype)
                                    <option value="{{$etype->id}}" {{ $data['etype_id'] == $etype->id ? 'selected' : '' }}>{{ $etype->emp_type}}</option>
                                    @endforeach
                                </select>
							</div>
						</div>

                        <div class="row mb-3">
							<div class="col">
                                <select lect name="designation" id="" class="form-control">
                                    @foreach ($designation as $des)
                                    <option value="{{ $des->id}}" {{ $data['desg_id'] == $des->id ? 'selected' : '' }} >{{ $des->des_title }}</option>
                                    @endforeach
                                </select>
							</div>
                            <div class="col">
								<select name="department" id="" class="form-control">
                                   @foreach ($department as $dep)
                                   <option value="{{ $dep->id}}" {{ $data['dep_id'] == $dep->id ? 'selected' : '' }}>{{ $dep->dep_name}}</option>
                                   @endforeach
                                </select>
							</div>
						</div>
                        <div class="row align-items-center">
                            <div class="col">
                            <div class="form-group">
							<label for="">Status</label>
							<select name="status" id="status" class="form-control">
								<option value="1" @if($data->status == 1) selected @endif> Active</option>
								<option value="0" @if($data->status == 0) selected @endif> Deactive</option>
							</select>
						</div>
                            </div>
                            <div class="col">
                            <button type="submit" class="btn btn-md btn-success">Update</button>
                            </div>
                        </div>


					</div>

				</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ url('/admin/main-assets/plugins/jquery/jquery.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

	<script>

        $('#dlt-des').click(function(){
            alert("are you sure");
        });
	</script>
@endsection

@extends('admin.layouts.app', ['page' => 'consumer'])

@section('title', 'تعديل مستهلك')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل مستهلك</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.consumers.update', ['consumer' => $consumer->id]) }}">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الاسم"
                            value="{{ old('name', $consumer->name) }}"
                            id="name"
                        >
                    </div>
                     <div class="form-group">
                        <label for="n_id">الرقم الوطني</label>
                        <input type="text"
                            class="form-control"
                            name="n_id"
                            required
                            placeholder="الرقم الوطني"
                            value="{{ old('n_id', $consumer->n_id) }}"
                            id="n_id"
                        >
                    </div>
                    <div class="form-group">
                        <label for="office">المكتب</label>
                        <select  id="office" name="office_id" class="form-control">
                            <option disabled value="0">المدينة | اسم المكتب</option>
                            @foreach($offices as $k=> $office)
                                <option value="{{$office->id }}" {{$office->id == old('office_id',$consumer->office_id) ? ' selected="selected"' : '' }} >{{$office->city}} | {{$office->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                   {{-- <div class="form-group">
                        <label for="location">Location</label>
                        <textarea class="form-control"
                            name="location"
                            id="location"
                            required
                            placeholder="Location"
                        >{{ old('location', $consumer->location) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input type="text"
                            class="form-control"
                            name="user_name"
                            required
                            placeholder="User Name"
                            value="{{ old('user_name', $consumer->user_name) }}"
                            id="user_name"
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                            class="form-control"
                            name="email"
                            required
                            placeholder="User Name"
                            value="{{ old('email', $consumer->email) }}"
                            id="email"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                            class="form-control"
                            name="password"
                            
                            placeholder="Password"
                            id="password"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password"
                            class="form-control"
                            name="password_confirmation"
                            
                            placeholder="Password"
                            id="password-confirmation"
                        >
                    </div>

                    <div class="form-group">
                        <label for="services">Service</label>
                        <select class="form-control"
                            name="services[]"
                            multiple
                            id="services">
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', $consumer->services)) ? 'selected' : '' }}
                                >
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>

                    <a href="{{ route('admin.consumers.index') }}" class="btn btn-default">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

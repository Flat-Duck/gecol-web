@extends('admin.layouts.app', ['page' => 'consumer'])

@section('title', 'إضافة مستهلك')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة مستهلك</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.consumers.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required
                            placeholder="الاسم"
                            value="{{ old('name') }}"
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
                            value="{{ old('n_id') }}"
                            id="n_id">
                    </div>

                    <div class="form-group">
                        <label for="office">مكتب الجباية</label>
                        <select  id="office" name="office_id" class="form-control select2">
                            <option disabled value="0">المدينة | اسم المكتب</option>
                            @foreach($offices as $k=> $office)
                                <option value="{{$office->id }}" {{$office->id == old('office_id') ? ' selected="selected"' : '' }} >{{$office->city}} | {{$office->name}}</option>
                            @endforeach
                        </select>
                    </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>

                    <a href="{{ route('admin.consumers.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

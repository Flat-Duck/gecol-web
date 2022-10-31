@extends('admin.layouts.app', ['page' => 'admins'])

@section('title', 'تعديل المستخدم')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل المستخدم</h3>
            </div>

<form role="form" method="POST" action="{{ route('admin.admins.update', ['admin' => $admin->id]) }}">
    @csrf
    @method('PUT')

    <div class="box-body">


        <div class="form-group">
            <label for="name">الإسم كامل</label>
            <input type="text"
                class="form-control"
                name="name"
                required
                placeholder="الإسم كامل"
                value="{{ old('name', $admin->name) }}"
                id="name"
            >
        </div>
        <div class="form-group">
            <label for="username">اسم المستخدم</label>
            <input type="text"
                class="form-control"
                name="username"
                required
                placeholder="اسم المستخدم"
                value="{{ old('username', $admin->username) }}"
                id="username"
            >
        </div>
      <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email"
                class="form-control"
                name="email"
                required
                placeholder="البريد الإلكتروني"
                value="{{ old('email', $admin->email) }}"
                id="email"
            >
        </div>    
    <input type="hidden" name="password" value="{{old('password', $admin->password)}}">
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">تعديل</button>

        <a href="{{ route('admin.admins.index') }}" class="btn btn-default">
            إلغاء
        </a>
    </div>
</form>
</div>
</div>
</div>
@endsection

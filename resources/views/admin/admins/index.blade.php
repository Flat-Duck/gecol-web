@extends('admin.layouts.app', ['page' => 'admins'])

@section('title', 'إدارة المستخدمين')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">المستخدمين</h3>

    <a class="pull-right btn btn-primary"
        href="{{ route('admin.admins.create') }}"
    >
        إضافة جديد
    </a>
</div>
<div class="box-body">
    <table class="table table-bordered">
      <thead>
        <tr>
            <th>#</th>
            <th>الاسم كامل</th>
            <th>إسم المستخدم</th>
            <th>البريد الالكتروني</th>
            <th>العمليات</th>
        </tr>
</thead>
<tbody>
        @forelse ($admins as $k=> $admin)
            <tr>
                <td>{{ $k+1}}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                
                    <a href="{{ route('admin.admins.edit', ['admin' => $admin->id]) }}">
                        <i style="color: orange;" class="fa fa-pencil-square-o"></i>
                    </a>

                    <form action="{{ route('admin.admins.destroy', ['admin' => $admin->id]) }}"
                        method="POST"
                        class="inline pointer"
                    >
                        @csrf
                        @method('DELETE')

                        <a onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }">
                       
                             <i data-toggle="tooltip"  title="حذف" class='fa fa-trash'></i>
                       
                        </a>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">لاتوجد سجلات</td>
            </tr>
        @endforelse
        </tbody>
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $admins->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection

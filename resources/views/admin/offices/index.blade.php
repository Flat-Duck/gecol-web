@extends('admin.layouts.app', ['page' => 'office'])

@section('title', 'مكاتب الجباية')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">مكاتب الجباية</h3>

                <a class="pull-right btn btn-sm btn-primary" href="{{ route('admin.offices.create') }}">
                    إضافة مكتب جباية
                </a>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($offices as $k=> $office)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $office->name }}</td>
                            {{-- <td>{{ $office->phone }}</td>
                            <td>{{ $office->user_name }}</td> --}}
                            <td>
                                <a href="{{ route('admin.offices.edit', ['office' => $office->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>

                                <form action="{{ route('admin.offices.destroy', ['office' => $office->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">لا توجد بيانات</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $offices->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection

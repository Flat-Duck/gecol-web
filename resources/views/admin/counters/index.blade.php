@extends('admin.layouts.app', ['page' => 'counter'])

@section('title', 'العدادات')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">العدادات</h3>

                <a class="pull-right btn btn-sm btn-primary" href="{{ route('admin.counters.create') }}">
                    إضافة عداد جديد
                </a>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>رقم العداد</th>
                        <th>القراءة الحالية</th>
                        <th> التاريخ</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($counters as $k=> $counter)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $counter->number }}</td>
                             <td>
                                {{-- {{ $counter->n_id }} --}}
                            </td>
                             <td>
                                {{-- {{ $counter->n_id }} --}}
                            </td>
                            {{--<td>{{ $counter->user_name }}</td> --}}
                            <td>
                                <a href="{{ route('admin.counters.edit', ['counter' => $counter->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>

                                <form action="{{ route('admin.counters.destroy', ['counter' => $counter->id]) }}"
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
                            <td colspan="5">لا توجد بيانات</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $counters->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection

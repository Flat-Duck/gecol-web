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
    <div class="searchbar mt-4 mb-5">
        <div class="row">                                      
            <div class="col-md-8">
                <form>
                    <div class="input-group margin col-md-4">
                        <input id="indexSearch" name="search" placeholder="Searsh" value="{{ $search ?? '' }}" type="text" class="form-control" spellcheck="false" data-ms-editor="true" autocomplete="off">
                        <span class="input-group-btn">                                    
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>                                
                </form>
            </div>                    
        </div>
    </div>
    <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>رقم العداد</th>
                        <th>القراءة الحالية</th>
                        <th> تاريخ الحالية</th>
                        <th>القراءة السابقة</th>
                        <th> تاريخ السابقة</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($counters as $k=> $counter)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $counter->number }}</td>
                            <td>{{ $counter->last_read()->value??  '-' }}</td>
                            <td>{{ $counter->last_read()->date??  '-' }}</td>
                            <td>{{ $counter->before_last_read()->value??  '-' }}</td>
                            <td>{{ $counter->before_last_read()->date??  '-' }}</td>
                            <td>
                                @if ($counter->is_active)
                                <span class="label label-success">مفعل</span>
                                @else
                                <span class="label label-danger">غير مفعل </span>
                                @endif
                            </td>                            
                             
                             
                            {{--<td>{{ $counter->user_name }}</td> --}}
                            <td>
                                <a href="{{ route('admin.counters.edit', ['counter' => $counter->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>

                                <a href="{{ route('admin.counters.add_reading', ['counter' => $counter->id]) }}">
                                    <i class="fa fa-plus"></i>
                                </a>

                                <form action="{{ route('admin.counters.destroy', ['counter' => $counter->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }">
                                        <i data-toggle="tooltip"  title="تغيير الحالة" class='fa fa-lock'></i>
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

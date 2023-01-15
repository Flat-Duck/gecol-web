@extends('admin.layouts.app', ['page' => 'consumer'])

@section('title', 'المستهلكين')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">المستهلكين</h3>

                <a class="pull-right btn btn-sm btn-primary" href="{{ route('admin.consumers.create') }}">
                    إضافة مستهلك جديد
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
                        <th>الاسم</th>
                        <th>الرقم الوطني</th>
                        <th>المكتب</th>
                        <th>المدينة</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($consumers as $k=> $consumer)
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $consumer->name }}</td>
                             <td>{{ $consumer->n_id }}</td>
                             <td>{{ $consumer->office? $consumer->office->name?? '-':'-'? }}</td>
                             <td>{{ $consumer->office? $consumer->office->city?? '-':'-'? }}</td>
                             <td>
                                @if ($consumer->is_active)
                                <span class="label label-success">مفعل</span>
                                @else
                                <span class="label label-danger">غير مفعل </span>
                                @endif
                            </td>
                            {{--<td>{{ $consumer->user_name }}</td> --}}
                            <td>
                                <a href="{{ route('admin.consumers.edit', ['consumer' => $consumer->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>

                                <form action="{{ route('admin.consumers.destroy', ['consumer' => $consumer->id]) }}"
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
                            <td colspan="3">لا توجد بيانات</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $consumers->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection

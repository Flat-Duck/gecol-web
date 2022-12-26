@extends('admin.layouts.app', ['page' => 'counter'])

@section('title', 'إضافة قراءة')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة قراءة</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.counters.store_reading',['counter' => $counter->id]) }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="number">رقم العداد</label>
                        <input disabled type="text"
                            class="form-control"

                            required
                            placeholder="رقم العداد"
                            value="{{ old('name',$counter->number) }}"
                            id="number"
                        >
                    </div>
                    <input type="hidden" name="number" value="{{$counter->number}}">
                    <div class="form-group">
                        <label for="value">القراءة </label>
                        <input  type="text"
                            class="form-control"
                            name="value"
                            required
                            placeholder=" القراءة"
                            value="{{ old('value') }}"
                            id="value"
                        >
                    </div>
                    <div class="form-group">
                        <label for="date">تاريخ القراءة </label>
                        <input  type="date"
                            class="form-control"
                            name="date"
                            required
                            placeholder="تاريخ القراءة"
                            value="{{ old('date') }}"
                            id="date"
                        >
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>

                    <a href="{{ route('admin.counters.index') }}" class="btn btn-default">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">قراءات العداد</h3>
            </div>
            <div class="box-body">    
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>القراءة</th>
                        <th>التاريخ</th>                    
                    </tr>
                    @php
                    $i =0;    
                    @endphp
                    @forelse ($readings as $k=> $reading)
                    @php
                    $i +=1;    
                    @endphp                    
                        <tr>
                            <td>{{ $k+1}}</td>
                            <td>{{ $reading->value??  '-' }}</td>
                            <td>{{ $reading->date??  '-' }}
                            @if ($i==1)
                            <span class="label label-success">الحالية</span>
                                
                            @endif
                            @if ($i==2)
                            <span class="label label-info">السابقة</span>
                            
                        @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">لا توجد بيانات</td>
                        </tr>
                        @endforelse
                </table>
            </div>        
        </div>
    </div>
</div>
@endsection

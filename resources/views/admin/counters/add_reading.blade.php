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
@endsection

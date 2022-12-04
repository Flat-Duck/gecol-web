@extends('admin.layouts.app', ['page' => 'counter'])

@section('title', 'إضافة عداد')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة عداد</h3>
            </div>

            <form role="form" method="POST" action="{{ route('admin.counters.store') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="number">رقم العداد</label>
                        <input type="text"
                            class="form-control"
                            name="number"
                            required
                            placeholder="رقم العداد"
                            value="{{ old('number') }}"
                            id="number"
                        >
                    </div>

                    <div class="form-group">
                        <label for="n_id">الرقم الوطني لصاحب العداد</label>
                        <input type="text"
                            class="form-control"
                            name="n_id"
                            required
                            placeholder="الرقم الوطني لصاحب العداد"
                            value="{{ old('n_id') }}"
                            id="n_id">
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

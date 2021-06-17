<div class="form-group">
    <label for="">Tashkilot INN</label>
    {{Form::text('company_tin', $organization->company_tin??null, ['class' => 'form-control','id'=>'tin'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot nomi</label>
    {{Form::text('company_name', $organization->company_name??null, ['class' => 'form-control','id'=>'acron_uz'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot statusi</label>
    {{Form::text('company_status', $organization->company_status??null, ['class' => 'form-control','id'=>'phone'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot viloyati</label>
    {{Form::select('company_ns10', [__('')]+Arr::pluck($regions,'name_uz','id'),$organization->company_ns10??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot tuman/shahri</label>
    {{Form::select('company_ns11', [__('')]+Arr::pluck($districts,'name_uz','id'),$organization->company_ns11??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot manzili</label>
    {{Form::text('company_adress', $organization->company_adress??null, ['class' => 'form-control','id'=>'addr'])}}
</div>
<div class="form-group">
    <label for="">Faoliyat turi</label>
    {{Form::textarea('performed_service', $organization->performed_service??null, ['class' => 'form-control'])}}
</div>


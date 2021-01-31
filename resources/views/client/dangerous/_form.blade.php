<div class="form-group">
    <label for="">Litsenziya raqami</label>
    {{Form::text('licence_number', $dangerous->licence_number??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya berilgan sana</label>
    {{Form::date('licence_given_date', $dangerous->licence_given_date??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Muddati</label>
    {{Form::date('end_date', $dangerous->end_date??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot INN</label>
    {{Form::text('organization_inn', $dangerous->organization_inn??null, ['class' => 'form-control','id'=>'tin'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot nomi</label>
    {{Form::text('organization_name', $dangerous->organization_name??null, ['class' => 'form-control','id'=>'acron_uz'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot telefon raqami</label>
    {{Form::text('organization_phone', $dangerous->organization_phone??null, ['class' => 'form-control','id'=>'phone'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot e-maili</label>
    {{Form::text('organization_email', $dangerous->organization_email??null, ['class' => 'form-control','id'=>'email'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot viloyati</label>
    {{Form::select('region_id', [__('')]+Arr::pluck($regions,'name_uz','id'),$dangerous->region_id??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot tuman/shahri</label>
    {{Form::select('district_id', [__('')]+Arr::pluck($districts,'name_uz','id'),$dangerous->district_id??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot manzili</label>
    {{Form::text('organization_address', $dangerous->organization_address??null, ['class' => 'form-control','id'=>'addr'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot rahbari</label>
    {{Form::text('organization_director', $dangerous->organization_director??null, ['class' => 'form-control','id'=>'head_nm'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot Hisob raqami</label>
    {{Form::text('organization_account_number', $dangerous->organization_account_number??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya murakkablik darajasi</label>
    {{Form::select('difficulty_category', [''=>'','I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV'], $dangerous->difficulty_category??null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya yo'nalishlari</label>
    {{Form::textarea('license_direction', $dangerous->license_direction??null, ['class' => 'form-control'])}}
</div>
<label for="types[]">Litsenziya yo'nalishi turlari</label>
<select multiple class="form-control" id="exampleFormControlSelect2" name="types[]">
    @foreach($types as $type)
        <option value="{{$type->id}}">{{$type->title}}</option>
    @endforeach
</select>
<script>
    $( "#tin" ).change(function() {
        let data = $('#tin').val();
        $.ajax({
            url: 'https://api.mc.uz/info-by-inn/' + data,
            type: 'GET',
            success: function(data){
                $('#acron_uz').val(data.acron_uz);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#founder_country1').val(data.founder_country1);
                $('#addr').val(data.addr);
                $('#head_nm').val(data.head_nm);
            }
        });
    });
</script>
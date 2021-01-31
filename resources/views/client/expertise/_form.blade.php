<div class="form-group">
    <label for="">Litsenziya raqami</label>
    {{Form::text('licence_number', $expertice->licence_number??'ҚЛЭ-', ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya berilgan sana</label>
    {{Form::date('licence_given_date', $expertice->licence_given_date??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Muddati</label>
    {{Form::date('end_date', $expertice->end_date??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot INN</label>
    {{Form::text('organization_inn', $expertice->organization_inn??null, ['class' => 'form-control','id'=>'tin'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot nomi</label>
    {{Form::text('organization_name', $expertice->organization_name??null, ['class' => 'form-control','id'=>'acron_uz'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot telefon raqami</label>
    {{Form::text('organization_phone', $expertice->organization_phone??null, ['class' => 'form-control','id'=>'phone'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot e-maili</label>
    {{Form::text('organization_email', $expertice->organization_email??null, ['class' => 'form-control','id'=>'email'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot viloyati</label>
    {{Form::select('region_id', [__('')]+Arr::pluck($regions,'name_uz','id'),$expertice->region_id??null, ['class' => 'form-control','id' => 'category1'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot tuman/shahri</label>
    {{Form::select('district_id', [__('')]+Arr::pluck($districts,'name_uz','id'),$expertice->district_id??null, ['class' => 'form-control subcat','disabled'=>'disabled', 'id'=>'category2'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot manzili</label>
    {{Form::text('organization_address', $expertice->organization_address??null, ['class' => 'form-control','id'=>'addr'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot rahbari</label>
    {{Form::text('organization_director', $expertice->organization_director??null, ['class' => 'form-control','id'=>'head_nm'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot Hisob raqami</label>
    {{Form::text('organization_account_number', $expertice->organization_account_number??null, ['class' => 'form-control'])}}
</div>
{{--<div class="form-group">
    <label for="">Litsenziya murakkablik darajasi</label>
    {{Form::select('difficulty_category', [''=>'','I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV'], $expertice->difficulty_category??null,['class' => 'form-control'])}}
</div>--}}
<div class="form-group">
    <label for="">Litsenziya yo'nalishlari</label>
    {{Form::textarea('license_direction', $expertice->license_direction??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Avvalgi Litsenziya raqami</label>
    {{Form::text('licence_number_old', $expertice->licence_number_old??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Avvalgi Litsenziya berilgan sana</label>
    {{Form::date('licence_given_date_old', $expertice->licence_given_date_old??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Sababi</label>
    {{Form::text('cause', $expertice->cause??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">MyGov ID</label>
    {{Form::text('mid', $expertice->mid??null, ['class' => 'form-control'])}}
</div>
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

    $(function(){

        var $cat = $("#category1"),
            $subcat = $(".subcat");

        var optgroups = {};

        $subcat.each(function(i,v){
            var $e = $(v);
            var _id = $e.attr("id");
            optgroups[_id] = {};
            $e.find("optgroup").each(function(){
                var _r = $(this).data("rel");
                $(this).find("option").addClass("is-dyn");
                optgroups[_id][_r] = $(this).html();
            });
        });
        $subcat.find("optgroup").remove();

        var _lastRel;
        $cat.on("change",function(){
            var _rel = $(this).val();
            if(_lastRel === _rel) return true;
            _lastRel = _rel;
            $subcat.find("option").attr("style","");
            $subcat.val("");
            $subcat.find(".is-dyn").remove();
            if(!_rel) return $subcat.prop("disabled",true);
            $subcat.each(function(){
                var $el = $(this);
                var _id = $el.attr("id");
                $el.append(optgroups[_id][_rel]);
            });
            $subcat.prop("disabled",false);
        });

    });
</script>

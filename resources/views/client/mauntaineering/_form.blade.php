<div class="form-group">
    <label for="">Faoliyat turi</label>
    {{Form::select('type_of_activity1', [''=>'','1' => 'Mudofaa obyektlarini loyihalashtirish, qurish, ulardan foydalanish va ularni tamirlash faoliyatini litsenziyalash', '2' => 'Ko`priklar va tonnellarni loyihalashtirish, qurish, ulardan foydalanish va ularni tamirlash faoliyatini litsenziyalash', '3' => 'Havfi yuqori bo`lgan obyektlarni hamda potensial havfli ishlab chiqarishlarni loyihalashtirish, qurish, ulardan foydalanish va ularni tamirlash faoliyatini litsenziyalash', '4' => 'Balandliklarda sanoat alpinizmi usullarida tamirlash, qurilish-montaj ishlarini bajarish faoliyatini litsenziyalash'], $mauntaineering->type_of_activity??null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya raqami</label>
    {{Form::text('licence_number', $mauntaineering->licence_number??'ҚВ-', ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya berilgan sana</label>
    {{Form::date('licence_given_date', $mauntaineering->licence_given_date??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Muddati</label>
    {{Form::date('end_date', $mauntaineering->end_date??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot INN</label>
    {{Form::text('organization_inn', $mauntaineering->organization_inn??null, ['class' => 'form-control','id'=>'tin'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot nomi</label>
    {{Form::text('organization_name', $mauntaineering->organization_name??null, ['class' => 'form-control','id'=>'acron_uz'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot telefon raqami</label>
    {{Form::text('organization_phone', $mauntaineering->organization_phone??null, ['class' => 'form-control','id'=>'phone'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot e-maili</label>
    {{Form::text('organization_email', $mauntaineering->organization_email??null, ['class' => 'form-control','id'=>'email'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot viloyati</label>
    {{Form::select('region_id', [__('')]+Arr::pluck($regions,'name_uz','id'),$mauntaineering->region_id??null, ['class' => 'form-control','id' => 'category1'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot tuman/shahri</label>
    {{Form::select('district_id', [__('')]+Arr::pluck($districts,'name_uz','id'),$mauntaineering->district_id??null, ['class' => 'form-control subcat','disabled'=>'disabled', 'id'=>'category2'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot manzili</label>
    {{Form::text('organization_address', $mauntaineering->organization_address??null, ['class' => 'form-control','id'=>'addr'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot rahbari</label>
    {{Form::text('organization_director', $mauntaineering->organization_director??null, ['class' => 'form-control','id'=>'head_nm'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot Hisob raqami</label>
    {{Form::text('organization_account_number', $mauntaineering->organization_account_number??null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Izoh</label>
    {{Form::textarea('license_direction', $mauntaineering->license_direction??null, ['class' => 'form-control'])}}
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
            url: 'http://api.mc.uz/inn/get-origin/' + data,
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

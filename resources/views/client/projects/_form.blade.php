
<div class="form-group">
    <label for="">Litsenziya raqami</label>
    {{Form::text('licence_number', $project->licence_number??'АЛ-', ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya berilgan sana</label>
    {{Form::date('licence_given_date', $project->licence_given_date??null, ['class' => 'form-control'])}}
</div>


<div class="form-group">
    <label for="">Tashkilot INN</label>
    {{Form::text('organization_inn', $project->organization_inn??null, ['class' => 'form-control','id'=>'tin'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot nomi</label>
    {{Form::text('organization_name', $project->organization_name??null, ['class' => 'form-control','id'=>'acron_uz'])}}
</div>
<div class="form-group">
    <label for="">Tashkilot telefon raqami</label>
    {{Form::text('organization_phone', $project->organization_phone??null, ['class' => 'form-control','id'=>'phone'])}}
</div>


{{Form::hidden('organization_account_number', 'null')}}
<div class="form-group">
    <label for="">Litsenziya murakkablik darajasi</label>
    {{Form::select('difficulty_category', [''=>'','I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV'], $project->difficulty_category??null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="">Litsenziya yo'nalishlari</label>
    {{Form::textarea('license_direction', $project->license_direction??null, ['class' => 'form-control'])}}
</div>


<div class="form-group">
    <label for="">Ariza raqami</label>
    {{Form::text('mid', $project->mid??null, ['class' => 'form-control'])}}
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

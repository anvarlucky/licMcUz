<div class="form-group col-md-12">
    <br/>
    <label>Sarlavha</label>
    {{Form::text('title', $announcement->title??null, ['class' => 'form-control'])}}
    <br>
    <label>Matn</label>
    {{Form::textarea('text', $announcement->text??null, ['class' => 'form-control'])}}
    <br>
    <label>Sana</label>
    {{Form::date('date', $announcement->date??null, ['class' => 'form-control'])}}
    <br>
    <label>Muammo rasmi</label>
    {{Form::file('image', $announcement->image??null, ['class' => 'form-control'])}}
    <br><label>Dasturni tanlang:</label>
    <select multiple class="form-control" id="exampleFormControlSelect2" name="shaffofprojects[]">
        @foreach($shaffofprojects as $shaffofproject)
            <option value="{{$shaffofproject->id}}">{{$shaffofproject->name}}</option>
        @endforeach
    </select>
</div>

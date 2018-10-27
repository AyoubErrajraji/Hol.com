<!-- AdType of Ad Form Input -->
<div class="form-group @if ($errors->has('type_id')) has-error @endif">
    {!! Form::label('type_id', 'Type') !!}
    {!! Form::select('type_id', array('1' => 'Product', '2' => 'Dienst'), null, ['class' => 'form-control']) !!}
    @if ($errors->has('type_id')) <p class="help-block">{{ $errors->first('type_id') }}</p> @endif
</div>

<!-- Title of Ad Form Input -->
<div class="form-group @if ($errors->has('title')) has-error @endif">
    {!! Form::label('title', 'Titel') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titel van Product']) !!}
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>

<!-- Text body Form Input -->
<div class="form-group @if ($errors->has('body')) has-error @endif">
    {!! Form::label('body', 'Beschrijving') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control ckeditor', 'placeholder' => 'Body of Product...']) !!}
    @if ($errors->has('body')) <p class="help-block">{{ $errors->first('body') }}</p> @endif
</div>

<!-- Price of Ad Form Input -->
<div class="form-group @if ($errors->has('price')) has-error @endif">
    {!! Form::label('price', 'Minimum Prijs') !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Prijs']) !!}
    @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
</div>

<!-- Image Form Input -->
<div class="form-group @if ($errors->has('image')) has-error @endif">
    {!! Form::label('image', 'Afbeelding') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
    @if(isset($product))
        <img src="{{asset('uploads/' . $product['image'])}}" style="max-width: 100px; margin-top: 10px;">
    @endif
    @if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
</div>

<!-- Closing date and time of Ad Form Input -->
<div class="form-group @if ($errors->has('closing_at_1')) has-error @endif @if ($errors->has('closing_at_2')) has-error @endif">
    {!! Form::label('closing_at_1', 'Sluiting') !!}

    {!! Form::date('closing_at_1', isset($product) ? $product['closing_at_1'] :  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}

    {!! Form::time('closing_at_2', isset($product) ? $product['closing_at_2'] :  '23:59', ['class' => 'form-control']) !!}

    @if ($errors->has('closing_at_1')) <p class="help-block">{{ $errors->first('closing_at_1') }}</p> @endif
    @if ($errors->has('closing_at_2')) <p class="help-block">{{ $errors->first('closing_at_2') }}</p> @endif
</div>

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>

    toggleState = function () {
        var selected_option = $('#type_id').val();

        if (selected_option === '1') {
            $('#state_id').show();
            $('#state-div').show();
        }
        else{
            $("#state_id").hide();
            $('#state-div').hide();
        }
    }

    toggleState();

    $("#type_id").change(function () {
        toggleState();
    })
</script>

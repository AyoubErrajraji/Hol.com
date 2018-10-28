
<div class="box-body">
    <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title of product']) !!}
        @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
    </div>
    <div class="form-group @if ($errors->has('body')) has-error @endif">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control textarea', 'placeholder' => 'Body of product...', 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
        @if ($errors->has('body')) <p class="help-block">{{ $errors->first('body') }}</p> @endif

    </div>
</div>
<!-- /.box-body -->


@push('scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
    </script>
@endpush
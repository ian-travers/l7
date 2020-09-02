<div class="form-group">
    <label for="body">{{ __('misc.leave-your-comment') }}</label>
    <textarea id="body" name="body" rows="3" required
              class="form-control bg-dark text-info{{ $errors->has('body') ? 'is-invalid' : '' }}"></textarea>
    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>



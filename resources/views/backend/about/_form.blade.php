@php
  $headingSizes   = ['sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large', 'xl' => 'Extra Large'];
  $paragraphSizes = ['sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large'];
@endphp

<div class="mb-3">
  <label class="form-label">Eyebrow (small label above the heading, e.g. ABOUT ME)</label>
  <input type="text" name="eyebrow" class="form-control @error('eyebrow') is-invalid @enderror"
         value="{{ old('eyebrow', $about?->eyebrow) }}">
  @error('eyebrow')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
  <div class="col-md-8 mb-3">
    <label class="form-label">Heading</label>
    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror"
           value="{{ old('heading', $about?->heading) }}">
    @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-4 mb-3">
    <label class="form-label">Heading Size</label>
    <select name="heading_size" class="form-select @error('heading_size') is-invalid @enderror">
      @foreach ($headingSizes as $val => $label)
        <option value="{{ $val }}" @selected(old('heading_size', $about?->heading_size ?? 'lg') === $val)>{{ $label }}</option>
      @endforeach
    </select>
    @error('heading_size')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Photo</label>
  @if ($about?->photo)
    <div class="mb-2"><img src="{{ asset('public/uploads/about/' . $about->photo) }}" height="90" alt=""></div>
  @endif
  <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
  @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Photo Caption</label>
  <input type="text" name="photo_caption" class="form-control @error('photo_caption') is-invalid @enderror"
         value="{{ old('photo_caption', $about?->photo_caption) }}">
  @error('photo_caption')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
  <div class="col-md-8">
    <div class="mb-3">
      <label class="form-label">Paragraph 1</label>
      <textarea name="paragraph_1" rows="4" class="form-control @error('paragraph_1') is-invalid @enderror">{{ old('paragraph_1', $about?->paragraph_1) }}</textarea>
      @error('paragraph_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Paragraph 2</label>
      <textarea name="paragraph_2" rows="4" class="form-control @error('paragraph_2') is-invalid @enderror">{{ old('paragraph_2', $about?->paragraph_2) }}</textarea>
      @error('paragraph_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <label class="form-label">Paragraph Size (applies to both paragraphs)</label>
    <select name="paragraph_size" class="form-select @error('paragraph_size') is-invalid @enderror">
      @foreach ($paragraphSizes as $val => $label)
        <option value="{{ $val }}" @selected(old('paragraph_size', $about?->paragraph_size ?? 'md') === $val)>{{ $label }}</option>
      @endforeach
    </select>
    @error('paragraph_size')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

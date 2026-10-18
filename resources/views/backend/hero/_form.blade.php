<div class="row">
  <div class="col-md-4 mb-3">
    <label class="form-label">Greeting (e.g. Hello, I'm)</label>
    <input type="text" name="greeting" class="form-control @error('greeting') is-invalid @enderror"
           value="{{ old('greeting', $hero?->greeting ?? "Hello, I'm") }}">
    @error('greeting')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-8 mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $hero?->name) }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Role Title (small line under the name, e.g. ML Researcher)</label>
  <input type="text" name="role_title" class="form-control @error('role_title') is-invalid @enderror"
         value="{{ old('role_title', $hero?->role_title) }}">
  @error('role_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
  <div class="col-md-4 mb-3">
    <label class="form-label">Tagline Prefix (e.g. I work on)</label>
    <input type="text" name="tagline_prefix" class="form-control @error('tagline_prefix') is-invalid @enderror"
           value="{{ old('tagline_prefix', $hero?->tagline_prefix) }}">
    @error('tagline_prefix')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-8 mb-3">
    <label class="form-label">Typed Words (comma separated, e.g. Web Developer, Researcher)</label>
    <input type="text" name="typed_items" class="form-control @error('typed_items') is-invalid @enderror"
           value="{{ old('typed_items', $hero?->typed_items) }}">
    @error('typed_items')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Intro</label>
  <textarea name="intro" rows="4" class="form-control @error('intro') is-invalid @enderror">{{ old('intro', $hero?->intro) }}</textarea>
  @error('intro')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Status Line (small pill above the name)</label>
  <input type="text" name="status_text" class="form-control @error('status_text') is-invalid @enderror"
         value="{{ old('status_text', $hero?->status_text) }}" placeholder="e.g. Open to research collaborations">
  @error('status_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Photo Labels (comma separated, shown beside the photo)</label>
  <input type="text" name="photo_tags" class="form-control @error('photo_tags') is-invalid @enderror"
         value="{{ old('photo_tags', $hero?->photo_tags) }}" placeholder="e.g. Deep Learning, Computer Vision, Laravel">
  @error('photo_tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Badges (comma separated small chips, e.g. IEEE CSDE 2026, 1 Paper)</label>
  <input type="text" name="badges" class="form-control @error('badges') is-invalid @enderror"
         value="{{ old('badges', $hero?->badges) }}">
  @error('badges')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Photo</label>
  @if ($hero?->photo)
    <div class="mb-2"><img src="{{ asset('public/uploads/hero/' . $hero->photo) }}" height="90" alt=""></div>
  @endif
  <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
  @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label class="form-label">Button 1 Text</label>
    <input type="text" name="btn1_text" class="form-control" value="{{ old('btn1_text', $hero?->btn1_text) }}">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Button 1 Link (e.g. #projects)</label>
    <input type="text" name="btn1_link" class="form-control" value="{{ old('btn1_link', $hero?->btn1_link) }}">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Button 2 Text</label>
    <input type="text" name="btn2_text" class="form-control" value="{{ old('btn2_text', $hero?->btn2_text) }}">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Button 2 Link (e.g. #contact)</label>
    <input type="text" name="btn2_link" class="form-control" value="{{ old('btn2_link', $hero?->btn2_link) }}">
  </div>
</div>

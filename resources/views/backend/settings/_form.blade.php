<h5 class="mb-3">Site</h5>

<div class="mb-3">
  <label class="form-label">Site Name (shown in the browser title, navbar and footer)</label>
  <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror"
         value="{{ old('site_name', $setting?->site_name) }}">
  @error('site_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Logo</label>
    @if ($setting?->logo)
      <div class="mb-2"><img src="{{ asset('public/uploads/settings/' . $setting->logo) }}" height="50" alt=""></div>
    @endif
    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
    @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Favicon (png / ico / svg)</label>
    @if ($setting?->favicon)
      <div class="mb-2"><img src="{{ asset('public/uploads/settings/' . $setting->favicon) }}" height="32" alt=""></div>
    @endif
    <input type="file" name="favicon" class="form-control @error('favicon') is-invalid @enderror">
    @error('favicon')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Resume / CV (pdf, doc, docx)</label>
  @if ($setting?->resume)
    <div class="mb-2"><a href="{{ asset('public/uploads/settings/' . $setting->resume) }}" target="_blank">View current resume</a></div>
  @endif
  <input type="file" name="resume" class="form-control @error('resume') is-invalid @enderror">
  @error('resume')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<hr>
<h5 class="mb-3">Contact Info (shown in the Contact section)</h5>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Email</label>
    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $setting?->email) }}">
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
           value="{{ old('phone', $setting?->phone) }}">
    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Address</label>
  <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
         value="{{ old('address', $setting?->address) }}">
  @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<hr>
<h5 class="mb-3">Social Links (include https://; leave empty to hide the icon)</h5>

<div class="row">
  @foreach (['facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'github' => 'GitHub', 'twitter' => 'X (Twitter)', 'instagram' => 'Instagram', 'scholar' => 'Google Scholar'] as $field => $label)
    <div class="col-md-6 mb-3">
      <label class="form-label">{{ $label }}</label>
      <input type="text" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror"
             value="{{ old($field, $setting?->$field) }}">
      @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  @endforeach
</div>

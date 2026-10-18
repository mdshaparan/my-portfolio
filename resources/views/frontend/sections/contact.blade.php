@include('frontend.sections._title')
<div class="contact-panel reveal">
  <div class="contact-side">
    <div class="info-rows">
      {{-- Opens Gmail compose in a new tab instead of the default mail app --}}
      @if($site?->email)<div class="info"><span class="ic"><i class="bi bi-envelope"></i></span><div><h5>Email</h5><a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($site->email) }}" target="_blank" rel="noopener">{{ $site->email }}</a></div></div>@endif
      @if($site?->phone)<div class="info"><span class="ic"><i class="bi bi-telephone"></i></span><div><h5>Phone</h5><a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone) }}">{{ $site->phone }}</a></div></div>@endif
      @if($site?->address)<div class="info"><span class="ic"><i class="bi bi-geo-alt"></i></span><div><h5>Location</h5><p>{{ $site->address }}</p></div></div>@endif
    </div>
    @include('frontend.sections._social')
  </div>
  <div class="contact-form">
    @if(session('contact_success'))<div class="flash ok">{{ session('contact_success') }}</div>@endif
    @if($errors->contact->any())<div class="flash err">@foreach($errors->contact->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="{{ route('contact.send') }}">
      @csrf
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off">
      <div class="form-row">
        <div class="field"><label for="c-name">Name</label><input id="c-name" type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required></div>
        <div class="field"><label for="c-email">Email</label><input id="c-email" type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required></div>
      </div>
      <div class="field"><label for="c-subject">Subject</label><input id="c-subject" type="text" name="subject" placeholder="What is this about?" value="{{ old('subject') }}"></div>
      <div class="field"><label for="c-message">Message</label><textarea id="c-message" name="message" placeholder="Write your message here" required>{{ old('message') }}</textarea></div>
      <button type="submit" class="btn-ai">Send message <i class="bi bi-send"></i></button>
    </form>
  </div>
</div>

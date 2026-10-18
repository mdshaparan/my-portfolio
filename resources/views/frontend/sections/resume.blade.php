@include('frontend.sections._title')
@if($resumeUrl)
  <div class="window reveal">
    <div class="win-bar">
      <div class="win-dots"><i></i><i></i><i></i><span>resume.pdf</span></div>
      <div class="win-actions">
        <a class="dl" href="{{ $resumeUrl }}" download><i class="bi bi-download"></i> Download</a>
        <a class="op" href="{{ $resumeUrl }}" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i> Open in new tab</a>
      </div>
    </div>
    <iframe src="{{ $resumeUrl }}#view=FitH" title="Resume"></iframe>
  </div>
@else
  <div class="empty">The resume has not been uploaded yet. Upload a PDF in Admin &rarr; Site Settings.</div>
@endif

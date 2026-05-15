{{-- resources/views/components/form.blade.php --}}
@php
    $isContact = ($type ?? '') === 'contact';
@endphp
<form>
    @csrf
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label>Email Address</label>
        <input type="email" class="form-control" placeholder="Enter your email">
    </div>
    @if($isContact)
    <div class="form-group">
        <label>Subject</label>
        <input type="text" class="form-control" placeholder="Message subject">
    </div>
    @endif
    <div class="form-group">
        <label>Message</label>
        <textarea rows="5" class="form-control" placeholder="Write your message here..."></textarea>
    </div>
    <button type="submit" class="btn-primary w-100">Send Message</button>
</form>

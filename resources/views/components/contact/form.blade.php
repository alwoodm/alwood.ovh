<div class="contact-form-container">
    <div class="contact-form">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Imię i nazwisko</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Adres e-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="subject">Temat</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                @error('subject')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="message">Wiadomość</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn">Wyślij wiadomość</button>
        </form>
    </div>
</div>

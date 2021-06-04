<div>
    <h3>Welcome to {{ config('app.name', 'Laravel') }}!</h3>

    <p>
        Your account was created !!!<br><br>
        Username: {{ $email }}<br>
        Password: {{ $password }}<br>
        <br>
    </p>
    <p>We recommend to change the password at the first attempt.</p>

    <p>Thank you.</p>
</div>

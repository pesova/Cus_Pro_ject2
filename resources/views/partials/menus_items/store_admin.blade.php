<li>
    <a href="{{ route('customers') }}">
        <i class='uil uil-chat-bubble-user'></i>
        <span> Customers </span>
    </a>
</li>

<li>
    <a href="{{ route('transactions') }}">
        <i data-feather="credit-card"></i>
        <span> Transactions </span>
    </a>
</li>

<li>
    <a href="{{ route('stores') }}">
        <i class="uil uil-shop"></i>
        <span>Stores</span>
    </a>
</li>

<li>
    <a href="{{route('analytics')}}">
        <i data-feather="book-open"></i>
        <span> Analytics </span>
    </a>
</li>

<li>
    <a href="{{ route('debts.reminder') }}">
        <i data-feather="bell"></i>
        <span> Debt Reminders </span>
    </a>
</li>

<li>
    <a href="{{ route('assistants.add') }}">
        <i data-feather="users"></i>
        <span> Add Assistant </span>
    </a>
</li>

<li>
    <a href="{{ route('broadcast') }}">
        <i data-feather="message-square"></i>
        <span> Broadcast Message </span>
    </a>
</li>
<li>
    <a href="{{ route('complaint.form') }}">
        <i data-feather="book-open"></i>
        <span> Complaint Forms </span>
    </a>
</li>
<li>
    <a href="{{ route('complaint.log') }}">
        <i data-feather="book"></i>
        <span> Complaint Log </span>
    </a>
</li>
<li>
    <a href="{{ route('settings') }}">
        <i class="uil  uil-cog"></i>
        <span> Settings </span>
    </a>
</li>
<li>
    <a href="{{ route('notification') }}">
        <i data-feather="bell"></i>
        <span> Notifications </span>
    </a>
</li>


{{-- Todo: REmove this. it is only for super admin --}}
<li>
    <a href="{{ route('users') }}">
        <i data-feather="users"></i>
        <span> Users </span>
    </a>
</li>
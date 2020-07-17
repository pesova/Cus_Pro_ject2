<li>
    <a href="{{ route('customer.index') }}">
        <i class='uil uil-chat-bubble-user'></i>
        <span class="fourth"> Customers </span>
    </a>
</li>

<li>
    <a href="{{ route('transaction.index') }}">
        <i data-feather="credit-card"></i>
        <span class="fifth"> Transactions </span>
    </a>
</li>

<li>
    <a href="{{ route('store.index') }}">
        <i class="uil uil-shop"></i>
        <span class="third">Stores</span>
    </a>
</li>

{{-- <li>
    <a href="{{route('analytics')}}">
        <i data-feather="book-open"></i>
        <span> Analytics </span>
    </a>
</li> --}}

<li>
    <a href="{{ route('debtor.index') }}">
        <i data-feather="bell"></i>
        <span class="sixth"> Debtors </span>
    </a>
</li>

<li>
    <a href="{{ route('assistants.index') }}">
        <i data-feather="users"></i>
        <span class="seventh"> Assistants </span>
    </a>
</li>

 <li>
    <a href="{{ route('broadcast.index') }}">
        <i data-feather="message-square"></i>
        <span> Broadcast Message </span>
    </a>
</li>
{{-- <li>
    <a href="{{ route('complaint.create') }}">
        <i data-feather="book-open"></i>
        <span> Complaint Forms </span>
    </a>
</li> --}}
<li>
    <a href="{{ route('complaint.index') }}">
        <i data-feather="book"></i>
        <span> Complaint</span>
    </a>
</li>
<li>
    <a href="{{ route('setting') }}">
        <i class="uil  uil-cog"></i>
        <span class="second"> Settings </span>
    </a>
</li>


{{-- <li>
    <a href="{{ route('notification') }}">
        <i data-feather="bell"></i>
        <span> Notifications </span>
    </a>
</li> --}}

{{--todo: Remove this. it is for super admin only--}}
{{-- <li>
    <a href="{{ route('users.index') }}">
        <i data-feather="users"></i>
        <span> Users </span>
    </a>
</li> --}}

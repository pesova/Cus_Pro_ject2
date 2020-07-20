<li>
    <a href="{{ route('dashboard') }}">
        <i data-feather="home"></i>
        <span> Dashboard </span>
    </a>
</li>


<li>
    <a href="javascript: void(0);">
        <i class="uil uil-shop"></i>
        <span> Store </span>
        <span class="menu-arrow"></span>
    </a>

    <ul class="nav-second-level" aria-expanded="false">
        <li>
            <a href="{{ route('store.index') }}">Manage Store</a>
        </li>
        <li>
            <a href="{{ route('assistants.index') }}">Manage Store Assistant</a>
        </li>

    </ul>
</li>


<li>
    <a href="javascript: void(0);">
        <i data-feather="credit-card"></i>
        <span> Transactions </span>
        <span class="menu-arrow"></span>
    </a>

    <ul class="nav-second-level" aria-expanded="false">
        <li>
            <a href="{{ route('transaction.index') }}">Manage Transactions</a>
        </li>
        <li>
            <a href="{{ route('debtor.index') }}">Manage Debtors</a>
        </li>

    </ul>
</li>


<li>
    <a href="{{ route('customer.index') }}">
        <i class='uil uil-chat-bubble-user'></i>
        <span class="fourth"> Customers </span>
    </a>
</li>

{{-- <li>
    <a href="{{ route('transaction.index') }}">
<i data-feather="credit-card"></i>
<span class="fifth"> Transactions </span>
</a>
</li>


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
</li> --}}

<li>
    <a href="{{ route('broadcast.index') }}">
        <i data-feather="message-square"></i>
        <span> Broadcast Message </span>
    </a>
</li>

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
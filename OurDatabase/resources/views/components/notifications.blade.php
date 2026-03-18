<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>

#bellContainer {
    position: relative;
}

#bellBtn {
    position: relative;
}

#bellBtn i {
    font-size: 28px;
    color: #333;
    transition: color 0.2s;
}

#bellBtn:hover i {
    color: #c19a6b;
}

#bellBtn span {
    position: absolute;
    top: -5px;
    right: -8px;
    background: Red;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    color: white;
    font-size: 12px;
}


#bellDropdown {
    position: absolute;
    right: 0;
    width: 350px;
    max-width: 90vw;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 12px;
    box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
    padding: 10px;
    display: flex;
    flex-direction: column;
    opacity: 0;
    transform: translateY(-10px);
    transition: 0.25s ease;
    z-index: 9999;
    pointer-events: none;
}

#bellDropdown.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

#title {
    font-size: 18px;
    font-weight: 600;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding: 10px 15px;
    margin-bottom: 5px;
    color: #c19a6b;
}


#notificationsContainer {
    max-height: 400px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    scrollbar-width: none;
}

.Notification {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    margin: 8px 10px;
    border-radius: 10px;
    background: #f9f9f9;
    border: 2px solid transparent;
    transition: all 0.2s, transform 0.2s;
    box-shadow: 0px 1px 3px rgba(0,0,0,0.05);
}

.Notification:hover {
    background: #fff3e0;
    transform: translateY(-2px);
    box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
}

.low-stock { 
    border-color: #ff3b3b;
}

.stock-added { 
    border-color: #28a745; 
}

.stock-decreased { 
    border-color: #d9534f; 
}

.Notification a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
}

.Notification a strong {
    color: #c19a6b;
}

.subText {
    color: #666;
    font-size: 12px;
}


.restockBtn{
    background-color: #c19a6b;
    color: white;
    font-weight: bold;
    border-radius: 6px;
    padding: 6px 12px;
    transition: background 0.2s, transform 0.2s;
}

.restockBtn:hover {
    background-color: #a0774e;
    transform: translateY(-1px);
}


#ViewBtn {
    text-align: center;
    padding: 10px 0;
    border-top: 1px solid rgba(0,0,0,0.1);
    background: #fff;
}

#ViewBtn a {
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
    color: #333;
    transition: color 0.2s;
}

#ViewBtn a:hover { 
    color: #c19a6b; 
}

</style>

<div id="bellContainer">
    <button id="bellBtn">
        <i class="bi bi-bell"></i>
        <span>{{ $notifications->count() }}</span>
    </button>

    <ul id="bellDropdown">
        <li id="title">Notifications</li>

        <div id="notificationsContainer">
            @foreach($notifications as $notif)
                <li class="Notification
                    @if($notif['type'] === 'low_stock') low-stock
                    @elseif($notif['type'] === 'restocked' && $notif['stock_change'] > 0) stock-added
                    @elseif($notif['type'] === 'restocked' && $notif['stock_change'] < 0) stock-decreased
                    @endif">
                    
                    <div class="Notification-content">
                        <a>
                            <strong>{{ $notif['product']->name }}</strong><br>
                            <small class="subText">
                                @if($notif['type'] === 'low_stock')
                                    Low stock alert
                                @elseif($notif['type'] === 'restocked' && $notif['stock_change'] > 0)
                                    Stock increased by {{ $notif['stock_change'] }}
                                @elseif($notif['type'] === 'restocked' && $notif['stock_change'] < 0)
                                    Stock decreased by {{ $notif['stock_change'] }}
                                @endif
                            </small><br>
                            <small class="subText">{{ $notif['product']->updated_at->diffForHumans() }}</small>
                        </a>
                    </div>

                    @if($notif['type'] === 'low_stock')
                        <button class="restockBtn" onclick="location.href='/admin/products'">Restock</button>
                    @endif
                </li>
            @endforeach
        </div>

        <li id="ViewBtn">
            <a href="/admin/products">View All</a>
        </li>
    </ul>
</div>

<script>
const bellBtn = document.getElementById('bellBtn');
const bellDropdown = document.getElementById('bellDropdown');
const RestockBtn = document.getElementsByClassName('restockBtn')

bellBtn.addEventListener('click', (event) => {
    event.stopPropagation();
    bellDropdown.classList.toggle('show');
});

document.addEventListener('click', (event) => {
    if (!bellDropdown.contains(event.target) && !bellBtn.contains(event.target)) {
        bellDropdown.classList.remove('show');
    }
});
</script>
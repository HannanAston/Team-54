<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <head>
        <style>
            #bellBtn {
                display: flex;
                justify-content: center;
                transform: translate(0%,25%)
                
            }

            #bellBtn i {
                font-size: 30px;
            }

            #bellBtn span {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                background: red;
                border-radius: 100px;
                width: 15px;
                height: 15px;
                color: white;
                font-size: 12px;
                //transform: translate(-75%, -50%)
            }

            #bellDropdown {
                display: flex;
                flex-direction: column;
                background: rgba(255,255,255,0.8);
                padding: 10px;
                width: 200%;
                border-width: 1px;
                box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
            }

            #title {
                font-size: 20px;
                border-bottom: 2px solid rgba(0,0,0,0.2);
                padding-bottom: 5px;
                margin-bottom: 15px;
            }

            .Notification {
                display: flex;
                justify-content: space-between;  /* push actions to the right */
                align-items: center;  
                border-bottom: 2px solid rgba(0,0,0,0.2);
                background: rgba(0,0,0,0.09);
                border-radius: 10px;
                margin: 5px;
                padding: 10px;
            }
            #ViewBtn {
                margin: 5px;
            }

            .notification-actions i {
                font-size: 25px;
            }


        </style>
    </head>

    <button id="bellBtn">
        <i class="bi bi-bell"></i>
        <span>1</span>
    </button>

    <ul id="bellDropdown">
        
        <li id="title"><strong>Notifications</strong></li>
        <li class=Notification>
            <a href="#">
                <strong>iPhone 15</strong><br>
                <small >Low stock alert</small><br>
                <small >2 min ago</small>
            </a>
            <div class="notification-actions">
                <i class="bi bi-check"></i>
                <!--<i class="bi bi-trash"></i>-->
            </div>
        </li>
        <li class=Notification>
            <a href="#">
                <strong>MacBook Pro</strong><br>
                <small>Stock updated</small><br>
                <small>1 hour ago</small>
            </a>
            <div class="notification-actions">
                <i class="bi bi-check"></i>
                <!--<i class="bi bi-trash"></i>-->
            </div>
        </li>
        <li id=ViewBtn>
            <a href="#">View All</a>
        </li>
    </ul>
</div>

<script>
    const bellBtn = document.getElementById('bellBtn');
    const bellDropdown = document.getElementById('bellDropdown');

    bellDropdown.style.display = "none";

    bellBtn.addEventListener('click', () => {
        bellDropdown.style.display = bellDropdown.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', (event) => {
        if (!bellBtn.contains(event.target) && !bellDropdown.contains(event.target)) {
            bellDropdown.style.display = 'none';
        }
    });
</script>
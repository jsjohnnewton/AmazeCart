<style>
    nav {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 30px;
        background-color: #D10024;
    }

    a {
        color: white;
    }

    nav ul {
        display: flex;
        gap: 20px;
        list-style: none;
    }

    a:hover {
        color: gray;
    }
</style>
<nav>
    <ul>
        <li>
            <a href="#" onclick="scrollToElement('mydashboard')">My dashboard</a>
        </li>
        <li>
            <a href="#" onclick="scrollToElement('myorder')">My Orders</a>
        </li>
        <li>
            <a href="{{url('myaccount')}}">Account Settings</a>
        </li>
    </ul>
</nav>

<script>
    function scrollToElement(elementId) {
        var element = document.getElementById(elementId);
        var offset = element.offsetTop - window.innerHeight / 6; // Adjust scroll position to be in the middle
        window.scrollTo({
            top: offset,
            behavior: 'smooth'
        });
    }
</script>
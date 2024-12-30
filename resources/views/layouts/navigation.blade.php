<style>
    .modern-modal {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .modal-header {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        border-bottom: 1px solid #e5e5e5;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .modal-header .close {
        color: #333;
    }

    .chatbox {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .user-message {
        align-self: flex-end;
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 15px 15px 0 15px;
        max-width: 75%;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    }

    .bot-message {
        align-self: flex-start;
        background-color: #e9ecef;
        color: #333;
        padding: 10px 15px;
        border-radius: 15px 15px 15px 0;
        max-width: 75%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .modal-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e5e5e5;
        padding: 8px;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .input-group .form-control {
        box-shadow: none;
        border: 1px solid #ddd;
    }

    .input-group .btn-primary {
        padding: 0 15px;
    }

    .chatbox::-webkit-scrollbar {
        width: 6px;
    }

    .chatbox::-webkit-scrollbar-thumb {
        background-color: #bbb;
        border-radius: 5px;
    }

    .chatbox::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .notification-item {
        background-color: #f1f8ff;
        color: #333;
        margin: 5px 0;
        padding: 8px 10px;
        line-height: 1.5;
        border-bottom: 1px solid #d0e7ff;
        transition: background-color 0.2s;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        background-color: #e0f2ff;
        text-decoration: none;
    }

    .invisible {
        opacity: 0;
        visibility: hidden;
    }

    .bg-lightblue {
        background-color: #e0f7fa;
    }

    .nav-link i {
        font-size: 1.2rem;
        width: 25px;
        height: 25px;
        line-height: 25px;
        text-align: center;
        border-radius: 50%;
        background: transparent;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link i:hover {
        background-color: rgba(13, 11, 13, 0.1);
        color: #FFF574;
    }

    .img-thumbnail {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        margin-left: 10px;
    }

    .navmenu {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-right: 10px;
    }

    .nav-links {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-links li {
        margin: 0 10px;
    }

    .nav-links a {
        text-decoration: none;
        color: inherit;
    }

    .nav-actions {
        position: relative;
        display: flex;
        align-items: center;
        gap: 15px;
        right: 30px;
        justify-content: flex-start;
        /* Ensure items align to the left */
    }

    .nav-actions img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        object-fit: cover;
        margin-left: -15px;
    }

    .nav-actions .nav-link {
        display: flex;
        align-items: center;
        color: inherit;
        text-decoration: none;
    }

    .nav-actions .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        font-size: 10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 4px;
    }

    .nav-link .fa-bell {
        font-size: 1.5rem;
        position: relative;
        margin-right: 5px;
    }

    .nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .nav-link .fa-bell {
        font-size: 1.5rem;
        position: relative;
        right: 10px;
    }

    .nav-link .badge {
        position: absolute;
        top: -px;
        right: 15px;
        font-size: 10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        line-height: 1;
    }

    .nav-actions .nav-link {
        display: flex;
        align-items: center;
        color: inherit;
        text-decoration: none;
        padding: 0 8px;
    }

    .mobile-nav-toggle {
        position: relative;
        right: 50px;
    }

    .nav-actions .nav-link i {
        font-size: 1.3rem;
        width: 22px;
        height: 22px;
        line-height: 22px;
        text-align: center;
        border-radius: 50%;
        background: transparent;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-actions .badge {
        font-size: 9px;
        padding: 2px 4px;
    }

    #chatModal .modal-footer .input-group .form-control {
        width: 200px;
    }

    #chatModal .modal-footer .input-group-append button {
        padding: 5px 10px;
    }


    .nav-actions img {
        max-width: 25px;
        max-height: 25px;
        border-radius: 50%;
        object-fit: cover;
        margin-left: -30px;
    }

    .dropdown-menu {
        max-height: 300px;
        overflow-y: auto;
    }

    @media (max-width: 1024px) {
        .dropdown-menu {
            width: 80%;
            max-height: 250px;
        }
    }

    @media (max-width: 768px) {
        .dropdown-menu {
            width: 90%;
            max-height: 200px;
        }
    }

    @media (max-width: 480px) {
        .dropdown-menu {
            width: 95%;
            max-height: 150px;
        }
    }
</style>


<header id="header" class="header d-flex align-items-center fixed-top bg-dark p-2">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('image/logo.jpg') }}" style="border-radius: 50%" alt="">
            <h1 class="sitename">Reporting System</h1>
        </a>


        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home.user') }}" class="active">Home</a></li>
                <li><a href="{{ route('user.incident') }}">Make Report</a></li>
                <li><a href="{{ route('user.report') }}">My Reports</a></li>
            </ul>

            <div class="dropdown position-relative">
                <a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" class="nav-link messages-toggle mx-1 text-primary">
                    <i style="font-size: 18px;" class="fa-solid fa-bell"></i>
                    <span
                        class="badge dashbg-1 position-absolute translate-middle
                            {{ $user->notifications->where('read_at', null)->count() === 0 ? 'invisible' : '' }}">
                        {{ $user->notifications->where('read_at', null)->count() }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdownMenuLink1"
                    style="max-height: 300px; overflow-y: auto; z-index: 1050; min-width: 300px;">
                    @if ($user && $user->notifications->count())
                        @php
                            $unreadNotifications = $user->notifications->where('read_at', null);
                        @endphp
                        @if ($unreadNotifications->count())
                            @foreach ($unreadNotifications as $notification)
                                <a class="dropdown-item notification-item bg-lightblue" style="color:black;"
                                    href="#" onclick="markAsRead('{{ $notification->id }}')">
                                    {{ $notification->data['name'] }}
                                </a>
                            @endforeach
                        @endif
                    @else
                        <div class="dropdown-item text-center rounded my-2 p-2 bg-light">No notifications</div>
                    @endif
                    @foreach ($user->notifications->where('read_at', '!=', null) as $notification)
                        <a class="dropdown-item bg-light notification-item" style="color:black;" href="#">
                            {{ $notification->data['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="nav-actions">
                <button type="button" class="nav-link mx-1" data-toggle="modal" data-target="#chatModal"
                    style="border:none;">
                    <i class="fa-solid fa-comment"></i>
                </button>

                <a href="{{ route('user.settings') }}" class="mx-1">
                    <img src="{{ asset($user->profile_image) }}" class="img-thumbnail" alt="Profile Image"
                        style="width: 25px; height: 25px; border-radius: 50%; object-fit: cover;">
                </a>
            </div>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>

</header>


<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Chat Bot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="chatbox" class="chatbox"></div>
            </div>
            <div class="modal-footer">
                <div class="input-group">
                    <input type="text" id="user-input" class="form-control" placeholder="Type a message...">
                    <div class="input-group-append">
                        <button type="button" id="send-button" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    function markAsRead(notificationId) {
        fetch(`/user/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    location.reload();
                } else {
                    alert(data.error || 'Error marking notification as read');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred. Please try again later.');
            });
    }
</script>

<script>
    $(document).ready(function() {
        $('.messages-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.dropdown-menu').toggle();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.messages-toggle').length) {
                $('.dropdown-menu').hide();
            }
        });

        $('#send-button').on('click', function() {
            var userInput = $('#user-input').val().trim();

            if (userInput) {
                $('#chatbox').append(
                    '<div style="text-align: right; color: white; background-color: #007bff; padding: 8px; border-radius: 12px; margin-bottom: 8px; max-width: 75%; align-self: flex-end;">' +
                    userInput + '</div>');
                $('#user-input').val('');

                $.ajax({
                    url: '/user/botman',
                    type: 'POST',
                    data: {
                        message: userInput,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response && response.status === 200 && Array.isArray(response
                                .messages)) {
                            response.messages.forEach(function(msg) {
                                if (msg.type === 'text' && msg.text !== userInput) {
                                    $('#chatbox').append(
                                        '<div style="text-align: left; color: black; background-color: #f1f1f1; padding: 8px; border-radius: 12px; margin-bottom: 8px; max-width: 75%;">' +
                                        msg.text + '</div>');
                                }
                            });
                        } else {
                            $('#chatbox').append(
                                '<div style="text-align: left; color: black; background-color: #f1f1f1; padding: 8px; border-radius: 12px; margin-bottom: 8px; max-width: 75%;">Unexpected response from bot.</div>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending message:", xhr.responseText);
                    }
                });
            } else {
                console.log("Input was empty.");
            }
        });
    });
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <title>Document</title>
</head>
<body>
    <header id="header" class="header header-wrapper">
        <div id="logo" class="flex-col logo">
            <!-- Header logo -->
            <a href="/" title="" rel="home">
                <svg class="w-16 h-16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"></path>
                    <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"></path>
                </svg>
            </a>
        </div>
        <ul class="user-action">
            <?php if (Auth::check()) {?>
                <li><a href="/user/profile" class="profile-button" style="cursor: pointer;"><?php echo Auth::user()->name ?></a></li>
                <li><a href="/user" class="manager-button" style="cursor: pointer;">Quản lý User</a></li>
            <?php } else {?>
                <li><a href="/login" class="login-button" style="cursor: pointer;">Đăng nhập</a></li>
                <li><a href="/register" class="register-button">Đăng ký</a></li>
            <?php }?>
        </ul>
    </header>
    <div class="manager-user">
        <div class="add-user">Add user</div>
        <table class="table table-hover table-list-user">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Date active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $list_users = DB::table('users')->get();
                    
                    foreach ($list_users as $key => $value) {?>
                        <tr>
                            <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                            <td class="text-center user"><?php echo $value->name; ?></td>
                            <td class="text-center email"><?php echo $value->email; ?></td>
                            <td class="text-center pass"><?php echo $value->name; ?></td>
                            <td class="text-center date-active"><?php echo $value->created_at; ?></td>
                            <td class="text-center">
                                <span class="edit">Edit</span>
                                <span class="remove">Remove</span>
                            </td>
                        </tr>
                    <?php }
                ?>
            </tbody>
        </table>
    </div>
    <footer id="footer">
        
    </footer>


</body>
</html>
<label for="username">Username</label>
<input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Username"
    disabled value="{{$user["username"]}}"/>
<label for="password">Password</label>
<div class="w-full flex border-2 rounded-md">
    <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********"
        disabled value="{{ $user['password'] }}" />
    <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
            alt="show"></button>
</div>

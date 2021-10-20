@if (request()->is('posts/create'))
    <footer class="bg-white text-center border-top width-100 pt-3 fixed-bottom">
        <p>© 2021, StartNow. All right reserved.</p>
    </footer>
@else
    <footer class="bg-white text-center width-100 border-top pt-3 fixed-bottom {{ request()->is('profile') ? 'position-absolute bottom-0 start-0' : '' }}">
        <p>© 2021, StartNow. All right reserved.</p>
    </footer>
@endif
